<?php
    class guest
    {
        private $id;
        private $firstname = "";
        private $lastname = "";
        private $middle_Initial = "";
        private $address = "";
        private $contact_no = "";
        private $email_add = "";
        
        public guest($id, $firstname, $lastname, $middle_Initial, $address, $contact_no, $email_add){
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->middle_Initial = $middle_Initial;
            $this->address = $address;
            $this->contact_no = $contact_no;
            $this->email_add = $email_add; 
        }

        public int getid(){
            return $this->id;
        }

        public String getfirstname(){
            return $this->firstname;
        }

        public String getlastname(){
            return $this->lastname;
        }

        public String getmiddleinitial(){
            return $this->middle_Initial;
        }

        public String getaddress(){
            return $this->address;
        }

        public String getcontactno(){
            return $this->contact_no;
        }

        public String getemailadd(){
            return $this->email_add;
        }
    }
    
?>