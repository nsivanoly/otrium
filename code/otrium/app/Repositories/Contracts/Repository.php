<?php

namespace App\Repositories\Contracts;

interface Repository
{

    /**
     * Create by array
     *
     * @param array $attributes
     */
    public function create($attributes);

    /**
     * Get All
     */
    public function all();

    /**
     * Find by id
     *
     * @param mixed $id
     */
    public function find($id);

    /**
     * Update by id
     *
     * @param mixed $id
     * @param array $attributes
     */
    public function update($id, array $attributes);

    /**
     * Delete by id
     *
     * @param mixed $id
     */
    public function delete($id);
}
