<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService.
 */
class UserService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array $data
     *
     * @return User
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): User
    {
        return new User();
    }

    /**
     * @param User $user
     * @param array $data
     *
     * @return User
     * @throws \Throwable
     */
    public function update(User $user, array $data = []): User
    {
        DB::beginTransaction();

        try {
            // Handle thumbnail update if provided
            if(isset($data['thumbnail']))
            {
                $data['thumbnail'] = $user->uploadFile($data['thumbnail'], 'thumbnail');
            }
            $user->update($data);

        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this User. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function delete(User $user): User
    {
        if ($this->deleteById($user->id)) {
            return $user;
        }

        throw new GeneralException('There was a problem deleting this User. Please try again.');
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function restore(User $user): User
    {
        if ($user->restore()) {

            return $user;
        }

        throw new GeneralException(__('There was a problem restoring this User. Please try again.'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function destroy(User $user): bool
    {

        if ($user->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this User. Please try again.');
    }
}
