<?php
namespace App\Repositories\User;

interface UserRepository{
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
    public function getMe();

    /**
     * @param string $new_password
     * @return mixed
     */

    public function changePassword($new_password);




}

?>