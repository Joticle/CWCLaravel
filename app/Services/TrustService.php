<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Trust;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class TrustService.
 */
class TrustService extends BaseService
{
    /**
     * TrustService constructor.
     *
     * @param Trust $trust
     */
    public function __construct(Trust $trust)
    {
        $this->model = $trust;
    }

    /**
     * @param array $data
     *
     * @return Trust
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Trust
    {
        DB::beginTransaction();

        try {
            if (isset($data['image'])) {
                // Prepare button data
                $buttonData = null;
                if (isset($data['button']['url']) && isset($data['button']['target_blank'])) {
                    $buttonData = [
                        'url' => $data['button']['url'],
                        'target_blank' => $data['button']['target_blank'],
                    ];
                }
                $trust = Trust::create(['hub_id' => isset($data['hub_id']) ? $data['hub_id'] : 1, 'button' => json_encode($buttonData)]);
                $trust->image = $trust->uploadFile($data['image'], 'image');
                $trust->save();
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return new Trust();
    }

    /**
     * @param Trust $trust
     * @param array $data
     *
     * @return Trust
     * @throws \Throwable
     */
    public function update(Trust $trust, array $data = []): Trust
    {
        DB::beginTransaction();

        try {
            if (!empty($data['button']['url']) && !empty($data['button']['target_blank'])) {
                $data['button'] = [
                    'url' => $data['button']['url'],
                    'target_blank' => $data['button']['target_blank'],
                ];
            }
            if (isset($data['image'])) {
                $data['image'] = $trust->uploadFile($data['image'], 'image');
            }

            $trust->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Trust. Please try again.'));
        }

        DB::commit();

        return $trust;
    }

    /**
     * @param Trust $trust
     *
     * @return Trust
     * @throws GeneralException
     */
    public function delete(Trust $trust): Trust
    {
        if ($this->deleteById($trust->id)) {
            return $trust;
        }

        throw new GeneralException('There was a problem deleting this Trust. Please try again.');
    }

    /**
     * @param Trust $trust
     *
     * @return Trust
     * @throws GeneralException
     */
    public function restore(Trust $trust): Trust
    {
        if ($trust->restore()) {

            return $trust;
        }

        throw new GeneralException(__('There was a problem restoring this Trust. Please try again.'));
    }

    /**
     * @param Trust $trust
     *
     * @return Trust
     * @throws GeneralException
     */
    public function destroy(Trust $trust): bool
    {

        if ($trust->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Trust. Please try again.');
    }
}
