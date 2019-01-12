<?php
namespace App\Repositories\Incident;

interface IncidentRepository{
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
     *
     * @return mixed
     */

         /**
     * @param array $attr
     * @return mixed
     */
    public function saveByUser($attr = [],$field);


 /**
     * @param array $options
     * @return mixed
     */
    public function getAll($options);
    

    
}

?>