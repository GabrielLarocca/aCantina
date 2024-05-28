import React, { useEffect, useState } from "react";
import Layout from "../../../../layout/Layout";
import { getDataTable } from "../../../crud/pedido.crud";
import { Column } from "primereact/column";
import { formatBRL } from "../../../utils/Validation";
import moment from "moment";
import { getRelatorioGerais } from "../../../crud/relatorio.crud";
import BetterDataTableRelatorio from "../../../components/BetterDataTableRelatorio";

export default function RelatoriosIndex() {
	const [relatorioGerais, setRelatorioGerais] = useState(null);

	useEffect(() => {
		getRelatorioGerais().then(({ data }) => {
			setRelatorioGerais(data);
		})
	}, []);

	const relatoriosBoxesData = [
		{ title: 'Vendas Hoje', relatorio: relatorioGerais?.vendaHoje },
		{ title: 'Vendas Semana', relatorio: relatorioGerais?.vendaSemana },
		{ title: 'Vendas Mês', relatorio: relatorioGerais?.vendaMes },
		{ title: 'Vendas Ano', relatorio: relatorioGerais?.vendaAno },
		{ title: 'Usuarios', relatorio: relatorioGerais?.total_users },
		{ title: 'Pedidos', relatorio: relatorioGerais?.total_pedidos },
		{ title: 'Produtos', relatorio: relatorioGerais?.total_produtos },
	]

	return (
		<Layout title={'Relatórios'}>
			<div className="containerWhite mb-4">
				{relatoriosBoxesData.map(({ title, relatorio }, index) => (
					<div key={index} className="whiteBox">
						<h3 className="title">{title}</h3>
						<h4>{relatorio}</h4>
					</div>
				))}
			</div>

			<BetterDataTableRelatorio fetchEvent={getDataTable} crudButtons={false} idRow={`id`}>
				<Column field="id" header="ID" />
				<Column field="usuario.usr_name" header="Cliente" />
				<Column field="ord_state_order" header="Status de produção" />
				<Column field="ord_state_payment" header="Status do pagamento" />
				<Column field="ord_total" header="Valor da venda" body={({ ord_total }) => formatBRL(ord_total)} />
				<Column field="created_at" header="Venda realizada em" body={({ created_at }) => moment(created_at).format('DD/MM/YYYY HH:mm')} />
			</BetterDataTableRelatorio>
		</Layout>
	)
};