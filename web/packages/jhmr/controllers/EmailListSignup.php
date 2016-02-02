<?php namespace Concrete\Package\Jhmr\Controller {

    use Request;

    class EmailListSignup extends \Concrete\Core\Controller\Controller {

        const EMMA_PUBLIC_KEY           = '64d62844a46bf1626a3a',
              EMMA_PRIVATE_KEY          = '179dca70347aaa4cb701',
              EMMA_ACCOUNT_ID           = '1752981',
              EMMA_AUDIENCE_SEGMENT_ID  = '88981';

        /**
         * Handler mapped from the front-end.
         */
        public function complete(){
            $memberData = array(
                'email' => $this->postData()->email,
                'fields' => array(
                    'first_name' => $this->postData()->first,
                    'last_name'  => $this->postData()->last
                ),
                'group_ids' => array(self::EMMA_AUDIENCE_SEGMENT_ID)
            );

            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_USERPWD         => sprintf('%s:%s', self::EMMA_PUBLIC_KEY, self::EMMA_PRIVATE_KEY),
                CURLOPT_URL             => sprintf('https://api.e2ma.net/%s/members/signup', self::EMMA_ACCOUNT_ID),
                CURLOPT_POST            => count($memberData),
                CURLOPT_POSTFIELDS      => json_encode($memberData),
                CURLOPT_HTTPHEADER      => array('Content-type: application/json'),
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_SSL_VERIFYPEER  => false
            ));
            $head = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            echo json_encode((object)array('httpCode' => $http_code, 'head' => $head));
        }

        /**
         * Data is sent in JSON format as post body.
         * @return mixed|\stdClass
         */
        protected function postData(){
            if( $this->_postBody === null ){
                $this->_postBody = json_decode(file_get_contents('php://input'));
                if( empty($this->_postBody) ){
                    $this->_postBody = new \stdClass();
                }
            }
            return $this->_postBody;
        }

    }

}