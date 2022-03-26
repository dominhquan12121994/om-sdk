## Cấu hình

Thêm ServiceProvider vào file config/app.php

```php
'providers' => [
    // Other service providers...

    Inventory\RepositoryServiceProvider::class,
],
```

### Sử dụng

```php
<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Example\Controllers\Api;

use App\Http\Controllers\Api\AbstractApiController;
use Inventory\Modules\Example\Repositories\Contracts\ExampleInterface;

class ExampleController extends AbstractApiController
{

    protected $_exampleInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExampleInterface $exampleInterface)
    {
        parent::__construct();

        $this->_exampleInterface = $exampleInterface;
    }
```
All function in base repository
```
    public function getAll();
    public function getById($id);
    public function getOne($conditions = array(), $fetchOptions = array());
    public function getMore($conditions = array(), $fetchOptions = array(), $paginate = false);
    public function create($data = array());
    public function insert($listData = array());
    public function updateByCondition($conditions = array(), $fillData = array());
    public function updateById($id, $fillData = array());
    public function checkExist($conditions);
```