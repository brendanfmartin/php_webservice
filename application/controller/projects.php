<?php

/**
 * Class Home
 *
 * 
 * 
 * 
 *
 */
class Projects extends Controller
{
    
    public function index()
    {
        $projects_model = $this->loadModel('ProjectModel');
        $projects = $projects_model->getAllProjects();
        $projects = json_encode($projects);

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/projects/index.php';
    }

    /**
     * PAGE: getAllProjects
     * return all the projects
     * 
     */
    public function getAllProjects()
    {

        $projects_model = $this->loadModel('ProjectModel');
        $projects = $projects_model->getAllProjects();
        $projects = json_encode($projects);

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/projects/index.php';
    }

    public function addProject($name, $description)
    {
        echo 'addProject';
        $this->name = urldecode($name);
        $this->description = urldecode($description);
        $projects_model = $this->loadModel('ProjectModel');
        $projects_model->addProject($this->name, $this->description);


        // // if we have POST data to create a new song entry
        // if (isset($_POST["submit_add_song"])) {
        //     // load model, perform an action on the model
        //     $songs_model = $this->loadModel('SongsModel');
        //     $songs_model->addSong($_POST["artist"], $_POST["track"],  $_POST["link"]);
        // }

        // where to go after song has been added
        header('location: ' . URL . 'projects/index.php');

    }


}
