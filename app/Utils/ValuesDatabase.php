<?php

namespace App\Utils;

class ValuesDatabase
{
    const DB_CREATED_AT = 'created_at';
    const DB_UPDATED_AT = 'updated_at';
    const DB_DELETED_AT = 'deleted_at';

    const TABLE_ROLS = 'rols';
    const ROL_COLUMN_ID = 'id';
    const ROL_COLUMN_NAME = 'name';
    const ROL_COLUMN_DESCRIPTION = 'description';

    const TABLE_USERS = 'users';
    const USER_COLUMN_ID = 'id';
    const USER_COLUMN_ROL_ID = 'rol_id';
    const USER_COLUMN_NAME = 'name';
    const USER_COLUMN_EMAIL = 'email';
    const USER_COLUMN_PASSWORD = 'password';
    const USER_COLUMN_REMEMBER_TOKEN = 'remember_token';

    const TABLE_COMPANIES = 'companies';
    const COMPANY_COLUMN_ID = 'id';
    const COMPANY_COLUMN_NAME = 'name';
    const COMPANY_COLUMN_ADDRESS = 'address';
    const COMPANY_COLUMN_PHONE = 'phone';
    const COMPANY_COLUMN_EMAIL = 'email';
    const COMPANY_COLUMN_DESCRIPTION = 'description';

    const TABLE_BRANCHES = 'branches';
    const BRANCH_COLUMN_ID = 'id';
    const BRANCH_COLUMN_COMPANY_ID = 'company_id';
    const BRANCH_COLUMN_NAME = 'name';
    const BRANCH_COLUMN_ADDRESS = 'address';
    const BRANCH_COLUMN_PHONE = 'phone';
    const BRANCH_COLUMN_EMAIL = 'email';
    const BRANCH_COLUMN_DESCRIPTION = 'description';

    const TABLE_CLIENTS = 'clients';
    const CLIENT_COLUMN_ID = 'id';
    const CLIENT_COLUMN_NIP = 'nip';
    const CLIENT_COLUMN_NAME = 'name';
    const CLIENT_COLUMN_EMAIL = 'email';
    const CLIENT_COLUMN_PHONE = 'phone';
    const CLIENT_COLUMN_ADDRESS = 'address';

    const TABLE_TYPE_PRODUCTS = 'type_products';
    const TYPE_PRODUCT_COLUMN_ID = 'id';
    const TYPE_PRODUCT_COLUMN_NAME = 'name';

    const TABLE_PRODUCT_SIZES = 'product_sizes';
    const PRODUCT_SIZE_COLUMN_ID = 'id';
    const PRODUCT_SIZE_COLUMN_NAME = 'name';

    const TABLE_PRODUCTS = 'products';
    const PRODUCT_COLUMN_ID = 'id';
    const PRODUCT_COLUMN_TYPE_ID = 'type_id';
    const PRODUCT_COLUMN_SIZE_ID = 'size_id';
    const PRODUCT_COLUMN_NAME = 'name';
    const PRODUCT_COLUMN_DESCRIPTION = 'description';
    const PRODUCT_COLUMN_PRICE = 'price';
    const PRODUCT_COLUMN_IVA = 'iva';

    const TABLE_INVENTORIES = 'inventories';
    const INVENTORY_COLUMN_ID = 'id';
    const INVENTORY_COLUMN_PRODUCT_ID = 'product_id';
    const INVENTORY_COLUMN_PRODUCT_SIZE_ID = 'product_size_id';
    const INVENTORY_COLUMN_TYPE_ID = 'type_id';
    const INVENTORY_COLUMN_BRAND_ID = 'brand_id';
    const INVENTORY_COLUMN_STOCK = 'stock';

    const TABLE_SALES = 'sales';
    const SALE_COLUMN_ID = 'id';
    const SALE_COLUMN_USER_ID = 'user_id';
    const SALE_COLUMN_CLIENT_ID = 'client_id';
    const SALE_COLUMN_BRANCH_ID = 'branch_id';
    const SALE_COLUMN_TOTAL_AMOUNT = 'total_amount';

    const TABLE_SALE_DETAILS = 'sale_details';
    const SALE_DETAIL_COLUMN_ID = 'id';
    const SALE_DETAIL_COLUMN_SALE_ID = 'sale_id';
    const SALE_DETAIL_COLUMN_PRODUCT_ID = 'product_id';
    const SALE_DETAIL_COLUMN_QUANTITY = 'quantity';
    const SALE_DETAIL_COLUMN_PRICE_TOTAL = 'price_total';

}
