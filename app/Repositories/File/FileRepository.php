<?php
namespace App\Repositories\File;

interface FileRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param array $attr
     * @return mixed
     */
    public function save($attr = []);

    /**
     * @param $id
     * @param array $attr
     * @return mixed
     */
    public function update($id, $attr = []);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param int $client_id
     * @param file $file
     * @param array $attr
     * @return mixed
     */
    public function uploadFile($file, $attr = []);

             /**
     * @param array $attr
     * @return mixed
     */
    public function saveByUser($attr = [],$field);

     /**
     * @param $id
     * @return mixed
     */
    public function getAllByUser($options=[]);
  /**
     * @param $id
     * @return mixed
     */
    public function getFileByCategory($options=[], $category_id);

}
