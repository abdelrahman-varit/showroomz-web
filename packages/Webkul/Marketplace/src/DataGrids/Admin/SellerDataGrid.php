<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use DB;
use Webkul\Ui\DataGrid\DataGrid;

/**
 * Seller Data Grid class
 *
 * @author Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SellerDataGrid extends DataGrid
{
    /**
     *
     * @var integer
     */
    public $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('marketplace_sellers')
                ->leftJoin('customers', 'marketplace_sellers.customer_id', '=', 'customers.id')
                ->select('marketplace_sellers.id', 'marketplace_sellers.created_at', 'customers.email', 'marketplace_sellers.is_approved', 'marketplace_sellers.customer_id', DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_name'));

        $this->addFilter('customer_name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));
        $this->addFilter('id', 'marketplace_sellers.id');
        $this->addFilter('created_at', 'marketplace_sellers.created_at');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => trans('marketplace::app.admin.sellers.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'customer_name',
            'label' => trans('marketplace::app.admin.sellers.seller-name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => true,
            'wrapper' => function($row) {
                return '<a href="' . route('admin.customer.edit', $row->customer_id) . '">' . $row->customer_name . '</a>';
            }
        ]);

        $this->addColumn([
            'index' => 'email',
            'label' => trans('marketplace::app.admin.sellers.seller-email'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'created_at',
            'label' => trans('marketplace::app.admin.sellers.created-at'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'product',
            'label' => trans('marketplace::app.admin.sellers.product'),
            'type' => 'string',
            'searchable' => false,
            'sortable' => false,
            'closure' => true,
            'wrapper' => function($row) {
                return '<a href = "' . route('admin.marketplace.seller.product.search', $row->id) . '" class="btn btn-sm btn-primary pay-btn" name="seller_id" value="' . $row->id .'">' . trans('marketplace::app.admin.sellers.add-product') . '</a>';
            }
        ]);

        $this->addColumn([
            'index' => 'is_approved',
            'label' => trans('marketplace::app.admin.sellers.is-approved'),
            'type' => 'boolean',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'wrapper' => function($row) {
                if ($row->is_approved == 1)
                    return trans('marketplace::app.admin.sellers.approved');
                else
                    return trans('marketplace::app.admin.sellers.un-approved');
            }
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'type' => 'Delete',
            'method' => 'GET',
            'route' => 'admin.marketplace.sellers.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'product']),
            'icon' => 'icon trash-icon'
        ]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'type' => 'delete',
            'label' => trans('marketplace::app.admin.sellers.delete'),
            'action' => route('admin.marketplace.sellers.massdelete'),
            'method' => 'DELETE'
        ]);

        $this->addMassAction([
            'type' => 'update',
            'label' => trans('marketplace::app.admin.sellers.update'),
            'action' => route('admin.marketplace.sellers.massupdate'),
            'method' => 'PUT',
            'options' => [
                trans('marketplace::app.admin.sellers.approve') => 1,
                trans('marketplace::app.admin.sellers.unapprove') => 0
            ]
        ]);
    }
}