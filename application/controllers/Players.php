
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, origin");

class Players extends CI_Controller {

    //construct the player model
    public function __construct()
    {
            parent::__construct();
            $this->load->model('players_model');
            $this->load->helper('url_helper');
    }

    //return all players in database when this end point is hit
    public function index()
    {
            $data['players'] = $this->players_model->get_players();
            header('Content-Type: application/json');
            //return data as json
            echo json_encode($data);
    }

    //return players with matching $id
    public function view($id = NULL) {
        $data['players_item'] = $this->players_model->get_players($id);

        if (empty($data['players_item'])) {
                show_404();
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    //create players from sent JSON file
    public function create()
    {
        //if file exists
        if (isset($_FILES["file"]["tmp_name"])) {
        //file stored in temp file on computer
        //grab the stored file contents
        $file = file_get_contents($_FILES["file"]["tmp_name"]);
        //"decode" contents from json to array (without true to object)
        $characters = json_decode($file, true);
        //for each item inside players array add to "players_item array to 
        //send to model
        $players_item["name"] = $characters['Players'][0]["Name"];
        $players_item["age"] = $characters['Players'][0]["Age"];
        $players_item["City"] = $characters['Players'][0]["Location"]["City"];
        $players_item["Province"] = $characters['Players'][0]["Location"]["Province"];
        $players_item["country"] = $characters['Players'][0]["Location"]["Country"];
        //send completed players_item array to players model
        $this->players_model->set_players($players_item);
        }
    }
    //grab id from post and send to model to delete from players DB
    public function delete($id = NULL) {
        $data['players_item'] = $this->players_model->delete_players($id);
    }
}









        // if(is_uploaded_file($_FILES['userfile']['tmp_name'])) 
        // {  
        //         $myfile = fopen("testfile.txt", "w");
        // }

        // if (!is_null($this->input->post())){
        //         $myfile = fopen("testfile.txt", "w");
        //         fwrite($myfile, $data);
        //     } else {
        //         $myfile = fopen("testfilecccc.txt", "w");
        //     }

        // if (!is_null($this->input->post())){
               
        // $myfile = fopen("testfile.txt", "w");
        // $jsonIterator = new RecursiveIteratorIterator(
        //         new RecursiveArrayIterator(json_decode($_POST, TRUE)),
        //         RecursiveIteratorIterator::SELF_FIRST);
            
        //     foreach ($jsonIterator as $key => $val) {
        //         if(is_array($val)) {
                    
        //             fwrite($myfile, $key);
        //         } 
        //     }   

        // file_put_contents('reply.txt', print_r($_POST, true), FILE_APPEND);

        // return ['status' => 'success'];

        // }
        // $myfile = fopen("testfile.txt", "w");
        // $decode_data = json_decode($_POST);
        // foreach($decode_data as $key=>$value){

        //         fwrite($myfile, $value);
        // }
        
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //         if (isset($_FILES['files'])) {
        //                 $myfile = fopen("testfile.txt", "w");
        //                 fwrite($myfile, $_FILES['files']);
        //         }
        // }
        // var_dump($_FILES["file"]);
        // $myfile = fopen("testfile.txt", "w");
        // fwrite($myfile, $_FILES["file"]["name"]);
        // $file = file_get_contents($_FILES["file"]["tmp_name"]);
        // var_dump($file);
        // $characters = json_decode($file);
        // var_dump($characters[0]['id']);
        // var_dump($file[0][0]);
        // $myfile = fopen("testfile.txt", "w");
        // fwrite($myfile, $file);