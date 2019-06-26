<?php
  session_start();
  function ErrorMessage(){
    if(isset($_SESSION["ErrorMessage"])){
      $output = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
      $output .= htmlentities($_SESSION["ErrorMessage"]);
      $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
      unset($_SESSION["ErrorMessage"]);
      return $output;
    }
  }

  function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
      $output = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
      $output .= htmlentities($_SESSION["SuccessMessage"]);
      $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
      unset($_SESSION["SuccessMessage"]);
      return $output;
    }
  }
?>
