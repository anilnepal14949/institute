<?php
    /*
     *Delete data form
     */
    function delete_form($routeParams, $formId){
        $form = Form::open(['route'=>$routeParams,'method'=>'delete','class'=>'form_inline','id'=>$formId]);
        return $form .= Form::close();
    }

    /*
     *Delete File form
     */
    function delete_file_form($routeParams, $formId){
        $form = Form::open(['route'=>'delete.file','method'=>'post','id'=>$formId]);
        $form .= Form::hidden('filePath',$routeParams[0]);
        $form .= Form::hidden('fileType',$routeParams[1]);
        $form .= Form::hidden('fileName',$routeParams[2]);
        return $form .= Form::close();
    }




