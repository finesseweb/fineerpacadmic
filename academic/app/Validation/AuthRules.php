<?php

/**
 * --------------------------------------------------------------------
 * CODEIGNITER 4 - SimpleAuth
 * --------------------------------------------------------------------
 *
 * This content is released under the MIT License (MIT)
 *
 * @package    SimpleAuth
 * @author     GeekLabs - Lee Skelding 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://github.com/GeekLabsUK/SimpleAuth
 * @since      Version 1.0
 * 
 */

namespace App\Validation;

use App\Models\AuthModel;

class AuthRules
{


    public function validateUser(string $str, string $fields, array $data)
    {

        $model = new AuthModel();
        $user = $model->where('user_id', $data['email'])
                      ->first();

        if (!$user) {
            return false;
        }
        else{
//            echo "<pre>".$data['password'];print_r($user);exit;
//            return password_verify($data['password'], $user['password']);
            return md5($data['password'])==$user['password'];
        }

    }

    public function validateExists(string $str, string $fields, array $data)
    {
        $model = new AuthModel();
        $user = $model->where('user_id', $data['email'])
        ->first();

        if (!$user) {
            return false;
        } else {
            return true;
        }
    }

    




}