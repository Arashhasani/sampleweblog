<?php
/**
 * Created by PhpStorm.
 * User: Arash
 * Date: 12/30/2021
 * Time: 3:36 PM
 */

?>

@if($errors->any())

    <ul class="alert alert-danger p-4" style="list-style: none">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>

@endif
