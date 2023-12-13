<?php

namespace Bi\Users\Enums;

use Spatie\Permission\Models\Permission;
use Bi\Users\Interfaces\PermissionInterface;
use Bi\Helpers\Traits\Enum\ArrayableEnumTrait;
use Bi\Helpers\Traits\Enum\RandomableEnumTrait;
use Bi\Helpers\Traits\Enum\FilterableEnumTrait;

enum PermissionEnum: string implements PermissionInterface
{
    use ArrayableEnumTrait, RandomableEnumTrait, FilterableEnumTrait;

    case MASTER_VIEW = 'Master view';
    case MASTER_CREATE = 'Master create';
    case MASTER_UPDATE = 'Master update';
    case MASTER_DELETE = 'Master delete';

    case USERS_VIEW = 'Users view';
    case USERS_CREATE = 'Users create';
    case USERS_UPDATE = 'Users update';
    case USERS_DELETE = 'Users delete';

    case CONTRACTOR_VIEW = 'Contractor view';
    case CONTRACTOR_CREATE = 'Contractor update';
    case CONTRACTOR_UPDATE = 'Contractor create';
    case CONTRACTOR_DELETE = 'Contractor delete';

    case CUSTOMER_VIEW = 'Customer view';
    case CUSTOMER_CREATE = 'Customer create';
    case CUSTOMER_UPDATE = 'Customer update';
    case CUSTOMER_DELETE = 'Customer delete';

    case PROJECT_VIEW = 'Project view';
    case PROJECT_CREATE = 'Project create';
    case PROJECT_UPDATE = 'Project update';
    case PROJECT_DELETE = 'Project delete';

    case ESTIMATE_VIEW = 'Estimate view';
    case ESTIMATE_CREATE = 'Estimate create';
    case ESTIMATE_UPDATE = 'Estimate update';
    case ESTIMATE_DELETE = 'Estimate delete';

    case INVOICE_VIEW = 'Invoice view';
    case INVOICE_CREATE = 'Invoice create';
    case INVOICE_UPDATE = 'Invoice update';
    case INVOICE_DELETE = 'Invoice delete';

    case PRODUCT_VIEW = 'Product view';
    case PRODUCT_CREATE = 'Product create';
    case PRODUCT_UPDATE = 'Product update';
    case PRODUCT_DELETE = 'Product delete';

    case SERVICE_VIEW = 'Service view';
    case SERVICE_CREATE = 'Service create';
    case SERVICE_UPDATE = 'Service update';
    case SERVICE_DELETE = 'Service delete';

    case PRICE_VIEW = 'Price view';
    case PRICE_CREATE = 'Price create';
    case PRICE_UPDATE = 'Price update';
    case PRICE_DELETE = 'Price delete';

    public function getObject(): ?Permission
    {
        /** @phpstan-ignore-next-line */
        return Permission::where('name', $this->value)->first();
    }
}
