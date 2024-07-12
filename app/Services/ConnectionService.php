<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Connection;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class ConnectionService.
 */
class ConnectionService extends BaseService
{
    /**
     * ConnectionService constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->model = $connection;
    }

    /**
     * @param array $data
     *
     * @return Connection
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Connection
    {
        DB::beginTransaction();

        try {
            // Prepare button data
            $buttonData = [
                'text' => $data['button']['text'],
                'url' => $data['button']['url'],
                'target_blank' => $data['button']['target_blank'],
            ];

            $connection = Connection::create(['name' => $data['name'], 'description' => $data['description'], 'button' => json_encode($buttonData)]);

            if (isset($data['logo'])) {
                $connection->logo = $connection->uploadFile($data['logo'], 'logo');
            }

            if ($data['categories'] && isset($data['categories'][0]['icon'])) {
                $categoryData = [];
                foreach ($data['categories'] as $index => $category) {

                    $iconName = $connection->uploadFile($category['icon'], 'categories', true);

                    $categoryData[] = [
                        'name' => $category['name'],
                        'icon' => $iconName,
                    ];
                }

                $connection->categories = $categoryData;
                $connection->save();
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $connection;
    }

    /**
     * @param Connection $connection
     * @param array $data
     *
     * @return Connection
     * @throws \Throwable
     */
    public function update(Connection $connection, array $data = []): Connection
    {
        DB::beginTransaction();

        try {
            $data['button'] = [
                'text' => $data['button']['text'],
                'url' => $data['button']['url'],
                'target_blank' => $data['button']['target_blank'],
            ];
            if (isset($data['logo'])) {
                $data['logo'] = $connection->uploadFile($data['logo'], 'logo');
            }
            // existing categories
            $categories = $connection->categories;

            if (!empty($data['categories'])) {

                $categoryData = [];
                foreach ($data['categories'] as $index => $category) {

                    if(isset($category['icon'])) {
                        $iconName = $connection->uploadFile($category['icon'], 'categories', true, isset($categories[$index]->icon) ? $categories[$index]->icon : '');
                    }
                    else {
                        $iconName = $categories[$index]->icon;
                    }

                    $categoryData[] = [
                        'name' => $category['name'],
                        'icon' => $iconName,
                    ];
                }
                $data['categories'] = $categoryData;
            } else {
                $data['categories'] = $categories;
            }

            $connection->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Connection. Please try again.'));
        }

        DB::commit();

        return $connection;
    }

    /**
     * @param Connection $connection
     *
     * @return Connection
     * @throws GeneralException
     */
    public function delete(Connection $connection): Connection
    {
        if ($this->deleteById($connection->id)) {
            return $connection;
        }

        throw new GeneralException('There was a problem deleting this Connection. Please try again.');
    }

    /**
     * @param Connection $connection
     *
     * @return Connection
     * @throws GeneralException
     */
    public function restore(Connection $connection): Connection
    {
        if ($connection->restore()) {

            return $connection;
        }

        throw new GeneralException(__('There was a problem restoring this Connection. Please try again.'));
    }

    /**
     * @param Connection $connection
     *
     * @return Connection
     * @throws GeneralException
     */
    public function destroy(Connection $connection): bool
    {

        if ($connection->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Connection. Please try again.');
    }
}
