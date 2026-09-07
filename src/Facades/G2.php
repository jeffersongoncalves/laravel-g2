<?php

namespace JeffersonGoncalves\G2\Facades;

use Illuminate\Support\Facades\Facade;
use JeffersonGoncalves\G2\G2Client;
use JeffersonGoncalves\G2\Resources\Categories;
use JeffersonGoncalves\G2\Resources\Competitors;
use JeffersonGoncalves\G2\Resources\Products;
use JeffersonGoncalves\G2\Resources\Reports;
use JeffersonGoncalves\G2\Resources\Reviews;
use JeffersonGoncalves\G2\Resources\Tracking;

/**
 * @method static Reviews reviews()
 * @method static Products products()
 * @method static Reports reports()
 * @method static Competitors competitors()
 * @method static Categories categories()
 * @method static Tracking tracking()
 *
 * @see G2Client
 */
class G2 extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'g2';
    }
}
