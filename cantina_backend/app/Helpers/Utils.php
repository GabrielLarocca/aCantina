<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class Utils {
	public static function createAdminDataTableResult(Request $request, $model, $wheres, $columnsToFilter, $columnsRelationshipToFilter = null, $sortField = '', $sortOrder = 'asc', $with = null, $join = null) {
		$currentPage = $request->page + 1;

		Paginator::currentPageResolver(function () use ($currentPage) {
			return $currentPage;
		});

		$query = self::buildQuery($model, $wheres, $join);

		self::applyRelationshipsAndFilters($query, $with, $columnsToFilter, $columnsRelationshipToFilter, $request);

		self::applySorting($query, $sortField, $sortOrder);

		$result = $query->paginate($request->rows);

		self::formatDateFields($result);

		return $result;
	}

	private static function buildQuery($model, $wheres, $join) {
		return sizeof($wheres) > 0
			? (isset($join)
				? $model::join($join->table, $join->key_1, $join->condition, $join->key_2)->where($wheres)
				: $model::where($wheres))
			: $model::query();
	}

	private static function applyRelationshipsAndFilters($query, $with, $columnsToFilter, $columnsRelationshipToFilter, $request) {
		if (isset($with)) {
			$query->with($with);
		}

		if (trim($request->globalFilter) != "") {
			$query->where(function ($q) use ($columnsToFilter, $columnsRelationshipToFilter, $request) {
				if (isset($columnsToFilter)) {
					foreach ($columnsToFilter as $column) {
						$q->orWhere($column, 'LIKE', '%' . $request->globalFilter . '%');
					}
				}

				if (isset($columnsRelationshipToFilter)) {
					foreach ($columnsRelationshipToFilter as $relationKey => $relationValue) {
						$q->orWhereHas($relationKey, function ($r) use ($relationValue, $request) {
							$r->where($relationValue, 'LIKE', '%' . $request->globalFilter . '%');
						});
					}
				}
			});
		}
	}

	private static function applySorting($query, $sortField, $sortOrder) {
		if (trim($sortField != "")) {
			$query->orderBy($sortField, $sortOrder);
		}
	}

	private static function formatDateFields($result) {
		foreach ($result as &$item) {
			self::formatDateField($item, 'created_at');
			self::formatDateField($item, 'updated_at');
		}
	}

	private static function formatDateField($item, $field) {
		if (!empty($item->$field)) {
			$formattedField = Carbon::parse($item->$field)->format('m/d/Y H:i:s');
			$item->{$field . '_format'} = $formattedField;
		}
	}
}
