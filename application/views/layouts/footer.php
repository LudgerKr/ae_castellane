<footer class="pt-4 my-md-5 pt-md-5 border-top container">
  <div class="row">
    <div class="col-12 col-md">
      <img src="<?= site_url('assets/img/logoCastellane.png')?>" alt="erreur de chargement" width="150" height="150">
    </div>
    <div class="col-6 col-md">
      <ul class="list-unstyled text-small">
		  <li><a class="text-muted" href="<?= site_url('presente'); ?>">Présentation</a></li>
		  <li><a class="text-muted" href="<?= site_url('user/signup'); ?>">Inscription</a></li>
		  <li><a class="text-muted" href="<?= site_url('presente'); ?>">Présentation</a></li>
		  <li><a class="text-muted" href="<?= site_url('boutique'); ?>">Boutique</a></li>
		  <li><a class="text-muted" href="<?= site_url('forum'); ?>">Forum</a></li>
		  <li><a class="text-muted" onclick="document.getElementById('contact').style.display='block'">Contact</a></li>
      </ul>
    </div>
	  <div class="col-6 col-md">
      <ul class="list-unstyled text-small">
      <?php 
        if(!empty($_SESSION['connect']))
        {
        echo'
          <li><a class="text-muted" href="'.site_url('user/quizz').'">Quizz</a></li>
          <li><a class="text-muted" href="'.site_url('user/profil').'">Profil</a></li>
          <li><a class="text-muted" href="'.site_url('user/logout').'">Déconnexion</a></li>
        ';
        }
        else if(!empty($_SESSION['connect_admin']))
        {
        echo'
          <li><a class="text-muted" href="'.site_url('admin/accueil').'">Administrations</a></li>
          <li><a class="text-muted" href="'.site_url('user/logout').'">Déconnexion</a></li>
        ';
        }
        elseif(!empty($_SESSION['connect_monitor']))
        {
        echo'
          <li><a class="text-muted" href="'.site_url('monitor/accueil').'">Gestions Moniteur</a></li>
          <li><a class="text-muted" href="'.site_url('user/logout').'">Déconnexion</a></li>
        ';
        }
        else
        {
        echo'
          <li><a class="text-muted" href="'.site_url('user/signin').'">Connexion</a></li>
          <li><a class="text-muted" role="button" href="'.site_url('user/signup').'">Inscription</a></li>
        ';        
        }  
      ?>
		  </ul>
	  </div>
    <div class="col-6 col-md">
      <ul class="list-unstyled text-small">
		  <li>
			<a class="btn btn-success" target="blank" href="<?=site_url('user/terms')?>">Mentions Légales</a>	
		  </li>
		  <li>
			  <i class="mt-2 fa fa-phone"></i> 06.25.66.06.32 (Faux numéro)
		  </li>
      </ul>
    </div>
  </div>     
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137353005-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137353005-1');
</script>
  

<script>
      $(function() {
          var modalId = window.location.hash.substr(1);
          if (modalId != null && modalId.length > 0) {
              $('#' + modalId).modal('toggle');
          }
      })
  </script>
    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable({
          fixedHeader: true
        });
      });
    </script>
    <script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
		<script>
		$(document).ready(function(){
		  $('.toast').toast('show');
		});
		</script>
<script>
  let quiz = [];
<?php 
foreach($quizzQuestion as $question) {
  echo("\nquiz.push({});");
  echo("\nquiz[quiz.length-1].question = {id: ".$question['idQuestion'].", question: `".$question['question']."`};");
  echo("\nquiz[quiz.length-1].reponses = [];");
  foreach($quizzAnswers as $reponse) {
    if ($reponse['IdQuestion'] == $question['idQuestion']) {
        echo("\nquiz[quiz.length-1].reponses.push({id: ".$reponse['IdReponse'].",reponse: `".$reponse['reponse']."`});");
    }
  }
}
?>
let currentQuestion = -1;

nextQuestion();

function valid() {
    if (typeof($("input[name='reponse']:checked").val()) == "undefined") {
        $("#info").empty();
        $("#info").append('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Attention ! </strong> Aucune réponse sélectionné.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return;
    }
    $.post(
        '<?= site_url('/user/verifReponse')?>',
        {
          idQuestion: quiz[currentQuestion].question.id,
          idReponse : parseInt($("input[name='reponse']:checked").val())
        },

        function(data){
            if (data.rep == "next") {
                nextQuestion();
            } else if (data.rep == "finish") {
                $("#question").empty();
                $("#question").append("<div class='alert alert-success'><strong>Félicitation !</strong> Vous avez terminer le quizz <b>Votre note : "+data.note+"/"+quiz.length+"</b></div>");
                $("#leBouton").val("Page d'accueil");
                $("#leBouton").attr("onclick","location.href = '<?= site_url('user/note')?>'");
            } else if (data.rep == "failed") {
                $("#info").empty();
                $("#info").append("<ul>");
                for (var i=0;i<data.errors.length;i++) {
                    $("#info").append("<li><div class='alert alert-warning'><strong>Attention ! </strong>"+data.errors[i]+"</div></li>");
                }
                $("#info").append("</ul>");
            }
        },
        'json'
    );
}
function nextQuestion() {
    currentQuestion += 1;
    $("#question").empty();
    if (typeof(quiz[currentQuestion]) == "undefined") {
        $("#question").append('<div class="alert alert-warning"><strong>Attention ! </strong>Aucune questions existante</div>');
    }
    $("#question").append("<font size='5'>Question n°"+(currentQuestion+1)+"</font>:<br><br> ");
    $("#question").append("\n<font size='4'>"+quiz[currentQuestion].question.question+" </font><br><br>");
    var reponses = "";
    for (var i=0;i<quiz[currentQuestion].reponses.length;i++) {
        reponses += "<ul><li><div class='custom-control custom-radiomb-3'><input type='radio' class='custom-control-input' id='"+quiz[currentQuestion].reponses[i].id+"' name='reponse' value='"+quiz[currentQuestion].reponses[i].id+"'><label class='custom-control-label' for='"+quiz[currentQuestion].reponses[i].id+"'>"+quiz[currentQuestion].reponses[i].reponse+"</label></div></li></ul>";
        if (i < quiz[currentQuestion].reponses.length-1) {
            reponses += "<br>";
        }
    }
    $("#question").append(reponses);
}
</script>
 <script type="text/javascript">

 var dateheure = document.getElementById('dateheure');
  
 function MAJHeure()
 {
     window.setTimeout('MAJHeure()', 20000);
     var d = new Date();
  
     var heure = d.getHours();
     heure = ((heure < 10) ? '0' : '') + heure;
     var minutes = d.getMinutes();
     minutes = ((minutes < 10) ? '0' : '') + minutes;
  
     dateheure.innerHTML = heure + ' h ' + minutes;
 }
 MAJHeure();

 </script>


  </body>
</html>
