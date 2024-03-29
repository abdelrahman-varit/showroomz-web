<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use DB;
use Webkul\Ui\DataGrid\DataGrid;

/**
 * Product Data Grid class
 *
 * @author Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ProductDataGrid extends DataGrid
{
    /**
     *
     * @var integer
     */
    public $index = 'marketplace_product_id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('product_flat')
                ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
                ->join('marketplace_products', 'product_flat.product_id', '=', 'marketplace_products.product_id')
                ->leftJoin('marketplace_sellers', 'marketplace_products.marketplace_seller_id', '=', 'marketplace_sellers.id')
                ->leftJoin('customers', 'marketplace_sellers.customer_id', '=', 'customers.id')

                ->addSelect('marketplace_products.id as marketplace_product_id', 'product_flat.product_id', 'product_flat.sku', 'product_flat.name', 'marketplace_products.price', 'product_flat.price as   product_flat_price', 'marketplace_products.is_owner', 'marketplace_products.is_approved',  DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as seller_name'))
                ->where('channel', core()->getCurrentChannelCode())
                ->where('locale', app()->getLocale());

        $queryBuilder = $queryBuilder->leftJoin('product_inventories', function($qb) {
            $qb->on('product_flat.product_id', 'product_inventories.product_id')
                ->where('product_inventories.vendor_id', '<>', 0);
        });

        $queryBuilder
            ->groupBy('marketplace_products.id')
            ->addSelect(DB::raw('SUM(product_inventories.qty) as quantity'));

        $this->addFilter('seller_name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));
        $this->addFilter('sku', 'product_flat.sku');
        $this->addFilter('product_id', 'product_flat.product_id');
        $this->addFilter('price', 'product_flat.price');
        $this->addFilter('is_approved', 'marketplace_products.is_approved');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'product_id',
            'label' => trans('marketplace::app.admin.products.product-id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'seller_name',
            'label' => trans('marketplace::app.admin.sellers.seller-name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'sku',
            'label' => trans('marketplace::app.admin.products.sku'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('marketplace::app.admin.products.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'price',
            'label' => trans('marketplace::app.admin.products.price'),
            'type' => 'price',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'wrapper' => function($row) {
                if ($row->is_owner == 1)
                    return $row->product_flat_price;
                else
                    return $row->price;
            }
        ]);

        $this->addColumn([
            'index' => 'quantity',
            'label' => trans('marketplace::app.admin.products.quantity'),
            'type' => 'number',
            'sortable' => true,
            'searchable' => false,
            'filterable' => false
        ]);

        $this->addColumn([
            'index' => 'is_approved',
            'label' => trans('marketplace::app.admin.products.status'),
            'type' => 'boolean',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'wrapper' => function($row) {
                if ($row->is_approved == 1)
                    return trans('marketplace::app.admin.products.approved');
                else
                    return trans('marketplace::app.admin.products.un-approved');
            }
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'type' => 'Delete',
            'method' => 'GET',
            'route' => 'admin.marketplace.products.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'product']),
            'icon' => 'icon trash-icon'
        ]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'type' => 'delete',
            'label' => trans('marketplace::app.admin.products.delete'),
            'action' => route('admin.marketplace.products.massdelete'),
            'method' => 'DELETE'
        ]);

        $this->addMassAction([
            'type' => 'update',
            'label' => trans('marketplace::app.admin.products.update'),
            'action' => route('admin.marketplace.products.massupdate'),
            'method' => 'PUT',
            'options' => [
                trans('marketplace::app.admin.sellers.approve') => 1,
                trans('marketplace::app.admin.sellers.unapprove') => 0
            ]
        ]);
    }
}