<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * REST Controller to manage the RESTful APIs
 *
 * @author Prateek Gupta <prateek.gupta54@gmail.com>
 */
class REST_Controller extends MX_Controller
{
    /**
     * rest config from load->config
     * @var array
     */
    protected $rest_config = [];
    /**
     * Response Variable, Printed in the end
     * @var array|mixed
     */
    protected $response;
    /**
     * Request method
     * @var string|NULL
     */
    private $method;
    /**
     * Request content type
     * @var string|NULL
     */
    private $content_type;
    /**
     * Available allowed methods
     * @var array
     */
    private $allowed_methods = ['get', 'put', 'post', 'delete'];
    /**
     * Available Response Formats
     * @var array
     */
    private $formats = [
        'json' => 'application/json',
        'html' => 'text/html'
    ];
    /**
     * http header status code
     * @var integer
     */
    private $http_code = 200;

    public function __construct()
    {
        parent::__construct();
        $this->rest_config = $this->load->config('rest', true);
        $this->response = array('status' => true, /*'user_data' => array(),*/ 'error' => 0, 'message' => '');
        /** Lanuage switch */
       /* if($this->input->method()=="get"){
            if( $_GET['lan']!="en"){
                $_GET['lan']="tm";
            }
            $data = $_GET;
        }else{
            if( $_POST['lan']!="en"){
                $_POST['lan']="tm";
            }
            
            $data = $_POST;
        }*/
        /* Language switch ends here */
        self::_set_basics();
        self::check_rest_keys();
        $this->form_validation->set_error_delimiters('', '');

    }

    protected function _set_basics()
    {
        $method = $this->input->method();
        $this->method = in_array($method, $this->allowed_methods) ? $method : 'get';
        $parse = 'parse_' . $this->method;
        self::$parse();
        $content_type = $this->input->server('CONTENT_TYPE');
        if ($content_type) {
            $content_type =
                (strpos($content_type, ';') !== false ? current(explode(';', $content_type)) : $content_type);
        }
        $formats = array_flip($this->formats);
        if (isset($formats[$content_type])) {
            $this->content_type = $formats[$content_type];
        }
        $this->set_http_code(200);
    }

    protected function set_http_code($http_code = 200)
    {
        $this->http_code = $http_code;
    }

    private function check_rest_keys()
    {
        try {
            if (!$this->rest_config['enabled_login']) {
                return true;
            }

            $username = $this->input->server('PHP_AUTH_USER');
            $password = $this->input->server('PHP_AUTH_PW');
            $hauth = $this->input->server('HTTP_AUTHORIZATION');
            if ($username == null && $hauth) {
                $hauth = trim(str_replace('Basic', '', $hauth));
                list($username, $password) = explode(':', base64_decode($hauth));
            }

            $credential = $this->rest_config['credential'];
            if ($credential['username'] !== $username || $credential['password'] !== $password) {
                throw new Exception("Unautorized Request", NORMAL_WARNING);
            }

            return true;
        } catch (Exception $up) {
            self::handle_exception($up);
        }
    }

    private function handle_exception(Exception $up)
    {
        if ($this->rest_config['handle_exception'] !== true) {
            throw $up;
        }
        $this->response['status'] = false;
        $this->response['error'] = $up->getCode();
        $this->response['message'] = $up->getMessage();
        $this->response();
    }

    protected function process_exception(Exception $up)
    {
        $this->set_http_code($up->getCode());
        $this->response['code'] = $up->getCode();
        $this->handle_exception($up);
    }


    protected function response($output = null, $type = 'json')
    {   
        if ($output == null) {
            $output = $this->response;
        }
        $this->http_code > 0 || $this->http_code = 200;
        self::set_response_type($type);

        $this->output->set_status_header($this->http_code)->set_output(is_array($output) ? json_encode($output) :
            $output)->_display();

        //$this->api_log($output);
        
        exit();
    }

    protected function set_response_type($type = 'json')
    {
        // if type doesn't exist, change it to json
        if (isset($this->formats[$type]) || $this->formats[$type] = 'json') {
            $this->output->set_content_type($this->formats[$type]);
        }
    }

    public function _remap($method = '', $arguments = [])
    {
        try {

            $controller_method = $method . '_' . $this->method;

            if (!method_exists($this, $controller_method)) {
                throw new Exception("Requested method is not allowed", NORMAL_WARNING);
            }

            call_user_func_array([$this, $controller_method], $arguments);
        } catch (Exception $up) {
            self::handle_exception($up);
        }
    }

    public function put($key = null, $xss_clean = false)
    {
        if ($key === null) {
            return $this->put_data;
        }

        return isset($this->put_data[$key]) ? self::_xss_clean($this->put_data[$key], $xss_clean) : NULL;
    }

    protected function _xss_clean($value, $xss_clean = false)
    {
        return $xss_clean === true ? $this->security->xss_clean($value) : $value;
    }

    public function delete($key = null, $xss_clean = false)
    {
        if ($key === null) {
            return $this->delete_data;
        }

        return isset($this->delete_data[$key]) ? self::_xss_clean($this->delete_data[$key], $xss_clean) : NULL;
    } // already available in CI input class

    public function get($key = null, $xss_clean = false)
    { // cloned function
        return $this->input->get($key, $xss_clean);
    } // already available in CI input class

    public function post($key = null, $xss_clean = false)
    { // cloned function
        return $this->input->post($key, $xss_clean);
    }

    public function get_method()
    {
        return $this->router->method . '_' . $this->method;
    }

    public function get_jwt($data = [], $key = null)
    {
        if ($key == null) {
            $key = JWT_SECRET;
        }

        $token = array(
            'iss' => base_url(),
            'nbf' => time(),
            'iat' => time(),
            //	'exp' => strtotime('+1 days')
        );

        $token = array_merge($token, $data);

        return \Firebase\JWT\JWT::encode($token, $key, 'HS256');
    }

    public function validate_jwt($jwt = null, $key = null, $get_as = 'object', $optional = false)
    {
        try {
            if ($key == null) {
                $key = JWT_SECRET;
            }
            $jwt = !is_null($this->input->server('HTTP_AUTHENTICATION')) ? $this->input->server('HTTP_AUTHENTICATION') : $jwt;
//            $jwt || $jwt = $this->input->server('HTTP_AUTHENTICATION');;
            if (is_bool($jwt) && ($jwt === true)) {
                return null;
            }
            $this->jwt = \Firebase\JWT\JWT::decode($jwt, $key, ['HS256']); // will throw exceptions
            return $this->jwt;
        } catch (Firebase\JWT\ExpiredException $e) {
            if ($optional) {
                return null;
            }
            //$this->load->helper('chef_status');
            //updateChefStatusOffline($this, $jwt, $key, ['HS256']);
            $this->set_http_code(401);
            self::handle_exception(new Exception("Token has expired", TOKEN_EXPIRED));
        } catch (Exception $e) {
            if ($optional) {
                return null;
            }
            self::handle_exception($e);
        }
    }

    private function parse_put()
    {
        $this->put_data = json_decode($this->input->raw_input_stream, true);
    }

    private function parse_delete()
    {
        $this->delete_data = json_decode($this->input->raw_input_stream, true);
    }

    private function parse_get()
    {
    }

    private function parse_post()
    {
    }

    private function api_log($response=[]){

        $this->load->library('user_agent');

        if ($this->agent->is_browser())
        {
                $agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
                $agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
                $agent = $this->agent->mobile();
        }
        else
        {
                $agent = 'Unidentified User Agent';
        }

        $file_name='log_'.date('Y-m-d').'.txt';  
        
        $path ='api_log/';
        
        $fHandler=fopen($path.$file_name,'a+'); 

        $called_url = $this->router->module.'/'.$this->router->class.'/'.$this->router->method;
        
        if($this->input->method()=="get"){
            $data = $_GET;
        }else{
            $data = $_POST;
        }

        $log_info   ="***************** API get called ".gmdate('Y-m-d h:m:i')." ***************\n";
        $log_info   = $log_info."Called URL : ".$called_url."\n";
        $log_info   = $log_info."Method : ".$this->input->method()."\n";
        $log_info   = $log_info."IP Address : ".$this->input->ip_address()."\n";
        $log_info   = $log_info."User Agent : ".$agent."\n";
        $log_info   = $log_info."Platform   : ".$this->agent->platform()."\n";
       
        $log_info   = $log_info."Data : ".json_encode($data, JSON_PRETTY_PRINT)."\n";
        $log_info   = $log_info."response : ".json_encode($response)."\n";
        
        fwrite($fHandler,$log_info);
        fclose($fHandler); 
      
    }

    /* Get firebase JWT to share and earn functionality */
    public function get_firebase_jwt($uid)
    {
        $service_account_email = "firebase-adminsdk-y0vh8@village-fresh-mart-f3c7a.iam.gserviceaccount.com";
        $private_key = "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCccoBLODlSkQlC\nfk2N1FkYn/ZKx3GY1bsS8Ym6X+4fySLWcdRfag9FDyFcTqk4Cox9LQGCq7e/Nazu\n7nzszeBZT2AfFHKpkbp2mWkyEDiN0smYrXyLjCUJqrH+yLeZf9v8Q4jaF6hahLue\n/G6LmU/IG4fRqnMGga0cCkIrlzRSMG32KTMgDBdiEGUi+rg9tFU18wTzmo+UTcoK\nP/H865rC+sgsIHPbVrjfiCc7sUh8rsnbC8xdRXE27VHTQYo6WTyqsrNxtO7bot2S\n4cH2imVXhKiT9Ii2NEuCNdf96nhwfRPfN9xuLSlvxSSlPxvl6Qf3uDAKoKDWvyXm\nb0jNZ7XPAgMBAAECggEAKkxO4YdvACLUhRTO9RS/jgfZuDgaP38x2BpT6X78S72+\n3InkKHPtcvd3RpTB7bP0bfeYG/M/d8QUYHk8b23uRVdPnreRlMUgy+YIag+2qqmd\n9diZ/sTCUs3C2Cb+dNL78EV2H7kbvHV8oKyRWs71oh3HZ+mUteKjohwn7c8wxzOC\nR+mvdJ1Ni3zlwa/0V76jEQMNtFlZ1ifTK+ZkUEg9RUBsWTag98MsSdUKGpFutw8U\nrpB6UJjhh4bmwYqhtn6hFBbOvikfGRuPLhdjfRBXEt7HF7VQoowrTZPTjmlG/IhD\nHS1maI8XdCj8IyBBWy4qcnmZoUFxaMU+xU+rrH88eQKBgQDYvVwJaBV7jPDKEyst\nkzGxb1ZOwv24oc1R+VVaQMlhXgroncmHthIGFuXGV8A3fsiP1UR6gF5lG63w/Ebe\n6KldnHR0saGr5v6JLKMg+GWPnZKamWqHw8Z6cZe/pufUn5dnslCLy05RnyWePtud\nhpD1E8+kAuIHY2FvbWjoBWZ5ZQKBgQC4yUPf/MCsQzzqrMo1wshpJuA67h+LwPcf\nsWxF1dBXOMn/OxPPWHRrKoNf3spfBF/3oDGr6i1c3RKWC2PcF8oziSqZPLQiOmaT\nZY6wpcin95xZ2fBj27+xvu2SAEhjUuxpC3MWs4WDJbqGCYNB35MrqK+xier5LbCB\nT7Zd1N1ZIwKBgQCbREQ7xOGm6dfRm5vSAWGXEACPWebzLo5tDCZWCpV5eCpubCLk\nYs1UqXCf/1sHJn89cvWkoHN/ES4xtjh7FcfG9P8EXgBIqqlr0ZtnUitHkAVnVUJY\n0ipMqzWfqUzpKA8JzVcgXlvT4yPK0pL3rWAJAdE9WIdd7ZbugT2nAb9gdQKBgHXf\n/apOg2Hf6mYRH1S4EjvxjqxI5lqyF3JiLZ1GzYY2NbTYrMRhurH6BqALcLC4C7fc\nupLd6V4JsCeC0Iq/qj7ByyjBLm9/LZvs9t78gkmTjGtMuSoaLehm0QmHoKWrah+A\nLERY9Fw6nweN3esRgcIh8yGfxwJ5ANUcUkr81M5dAoGAZMZCUtGF9qC3M2wOC6Ba\nFU8IUk4+OpUEt8C3oxj9LkU08GdWRj1vfmUffZU6pG5whA7oqnlyEqwgIh9/FA2G\nkOrAyHr6bxrjOCuOY+ePy4tYU8xsMOsdWu0tT27Vcs+U/zUeKj93Xdo+ldllyQLd\n+YDX+qeCWzinA8s8K+Phay0=\n-----END PRIVATE KEY-----\n";

        $now_seconds = time();
          $payload = array(
            "iss" => $service_account_email,
            "sub" => $service_account_email,
            "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
            "iat" => $now_seconds,
            "exp" => $now_seconds+(60*60),  // Maximum expiration time is one hour
            "uid" => $uid,
          );

        return \Firebase\JWT\JWT::encode($payload, $private_key, 'RS256');
    }
}

/* End of file REST_Controller.php */
/* Location: ./application/core/REST_Controller.php */