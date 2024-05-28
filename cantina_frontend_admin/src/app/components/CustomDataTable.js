import React, { Component } from 'react';
import { DataTable } from 'primereact/datatable';
import { Link } from "react-router-dom";
import { Column } from 'primereact/column';
import Swal from 'sweetalert2';
import AddFillIcon from 'remixicon-react/AddFillIcon';
import EditBoxLineIcon from 'remixicon-react/EditBoxLineIcon';
import DeleteBinLineIcon from 'remixicon-react/DeleteBinLineIcon';
import { TextField } from '@material-ui/core';
import { toast } from 'react-toastify';

export default class CustomDataTable extends Component {
	constructor() {
		super();
		this.state = {
			tableData: [],
			rowsPerPage: 10,
			totalRecordsCount: 0,
			currentFirstRow: 0,
			currentLastRow: 0,
			isLoading: false,
			globalSearch: null
		};

		this.handlePageChange = this.handlePageChange.bind(this);
	}

	componentDidMount() {
		this.handlePageChange(this.state);
	}

	handleGlobalSearch = (value) => {
		this.setState({ globalSearch: value });

		setTimeout(() => {
			const updatedState = { ...this.state, globalSearch: value };
			this.handlePageChange(updatedState);
		}, 350);
	}

	refreshDataTable = () => {
		this.handlePageChange(this.state);
	}

	handlePageChange = (event) => {
		if (event.data) {
			event.data = null;
		}


		console.log(event)
		this.setState({ rowsPerPage: event?.rows ?? event.rowsPerPage, isLoading: true });

		this.props.fetchEvent(event).then(res => {
			const dataResponse = res.data.data;
			this.setState({
				tableData: dataResponse.data,
				totalRecordsCount: dataResponse.total,
				currentFirstRow: dataResponse.from - 1,
				currentLastRow: dataResponse.to - 1,
			});
		}).finally(() => {
			this.setState({ isLoading: false });
		});
	};

	handleDeleteRow = id => {
		Swal.fire({
			title: 'Atenção!',
			text: `Tem certeza que deseja remover esse ${this.props.btnTitle}?`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: "Não",
			confirmButtonText: 'Sim'
		}).then((result) => {
			if (result.value) {
				if (this.props.deleteHandler) {
					this.setState({ isLoading: true });

					this.props.deleteHandler(id).then(() => {
						this.refreshDataTable();
						this.setState({ isLoading: false });
						toast(`${this.props.btnTitle} removido com sucesso!`, { type: "success" });
					}).catch(({ response }) => {
						Swal.fire('Ops!', response?.data?.errors?.[0] ?? `Houve um problema ao remover o ${this.props.btnTitle}. Entre em contato com o suporte.`, 'error');
						this.setState({ isLoading: false });
					});
				} else {
					alert("Nenhum método de remoção definido.");
				}
			}
		});
	};

	renderCrudOptions = (rowData, column) => {
		const rowId = this.props.idRow || 'id';

		return this.props.crudUrl ? (
			<div style={{ textAlign: 'center' }}>
				{!this.props.noEdit && (
					<Link to={`${this.props.crudUrl}/edit/${rowData[rowId]}`} className="btn btn-success btn-table-action">
						<EditBoxLineIcon color='#FFF' size={18} />
					</Link>
				)}

				{!this.props.noShow && (
					<Link to={`${this.props.crudUrl}/show/${rowData[rowId]}`} className="btn btn-primary btn-table-action">
						<i className="fa-solid fa-eye"></i>
					</Link>
				)}

				{!this.props.noDelete && (
					<button onClick={() => this.handleDeleteRow(rowData[rowId])} className="btn btn-danger btn-table-action">
						<DeleteBinLineIcon color='#FFF' size={18} />
					</button>
				)}

				{this.props.moreOptions && this.props.moreOptions(rowData[rowId])}
			</div>
		) : null;
	};

	renderHeader = () => (
		this.props.noHeader ? null : (
			<div className="d-flex">
				{!this.props.noHeaderNewbtn && (
					<Link to={`${this.props.crudUrl}/new`}>
						<button className="btn btn-primary btn-elevate btnPrimary">
							<AddFillIcon color="#fff" size={18} style={{ marginRight: 12 }} />
							Adicionar {this.props.btnTitle}
						</button>
					</Link>
				)}

				<div className="form-group d-flex flex-column" style={{ marginLeft: 16, flex: 1 }}>
					<TextField
						variant='outlined'
						placeholder={`Encontre um ${this.props.btnTitle}`}
						margin="none"
						style={{ backgroundColor: '#fff', display: 'flex' }}
						type="search"
						onInput={(e) => { this.handleGlobalSearch(e.target.value); }}
					/>
				</div>
			</div>
		)
	);

	render() {
		return (
			<DataTable
				ref={(el) => this.dataTable = el}
				value={this.state.tableData}
				paginator={true}
				rows={this.state.rowsPerPage}
				rowsPerPageOptions={[10, 25, 50]}
				first={this.state.currentFirstRow}
				last={this.state.currentLastRow}
				header={this.renderHeader()}
				globalFilter={this.state.globalSearch}
				responsive={true}
				totalRecords={this.state.totalRecordsCount}
				lazy={true}
				onPage={this.handlePageChange}
				loading={this.state.isLoading}
				loadingIcon={`fa fa-sync fa-spin`}
				paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
				currentPageReportTemplate="Mostrando {first} até {last} de {totalRecords} registros"
				emptyMessage="Nenhum registro encontrado!"
			>
				{this.props.children}
				{this.props.crudButtons && (
					<Column header="Opções" body={this.renderCrudOptions} style={{ width: '190px' }} />
				)}
				{this.props.columnOpcoes && (
					<Column header="Opções" body={this.props.columnOpcoes} style={{ width: '190px' }} />
				)}
			</DataTable>
		);
	}
}