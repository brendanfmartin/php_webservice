<?php

class ProjectModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all projects from database
     */
    public function getAllProjects()
    {
        $sql = "SELECT * FROM project";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a project to database
     * @param string $project project
     * @param string $description description
     * @param string $link Link
     */
    public function addProject($name, $description)
    {
        // clean the input from javascript code for example
        $name = strip_tags($name);
        $description = strip_tags($description);
        $created_at = $updated_at = date('Y-m-d G:i:s');

        $sql = "INSERT INTO project (name, description, created_at, updated_at) VALUES (:name, :description, :created_at, :updated_at)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name, ':description' => $description, ':created_at' => $created_at, ':updated_at' => $updated_at));
    }

    /**
     * Add a project to database
     * @param string $project project
     * @param string $description description
     * @param string $link Link
     */
    public function updateProject($project, $description, $link)
    {
        // clean the input from javascript code for example
        $project = strip_tags($project);
        $description = strip_tags($description);
        $link = strip_tags($link);

        $sql = "UPDATE project (project, description, link) VALUES (:project, :description, :link)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':project' => $project, ':description' => $description, ':link' => $link));
    }

    /**
     * Delete a project in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $project_id Id of project
     */
    public function deleteproject($project_id)
    {
        $sql = "DELETE FROM project WHERE id = :project_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':project_id' => $project_id));
    }

    
}
