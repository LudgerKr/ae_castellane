<footer class="pt-4 my-md-5 pt-md-5 border-top">
  <div class="row">
    <div class="col-12 col-md">
      <small class="d-block mb-3 text-muted"></small>
    </div>
    <div class="col-6 col-md">
      <h5></h5>
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
        <h5></h5>
        <ul class="list-unstyled text-small">
        <?php 
          if(!empty($_SESSION['connect']))
          {
            echo'
              <li><a class="text-muted" href="'.site_url('user/quizz').'">Quizz</a></li>
              <li><a class="text-muted" href="'.site_url('user/profil').'">Profil</a></li>
              <li><a class="text-muted" href="'.site_url('user/logout').'">Déconnexion</a></li>
            ';
          }else if(!empty($_SESSION['connect_admin']))
          {
            echo'
              <li><a class="text-muted" href="'.site_url('admin/accueil').'">Administrations</a></li>
              <li><a class="text-muted" href="'.site_url('user/logout').'">Déconnexion</a></li>
            ';
          }elseif(!empty($_SESSION['connect_monitor']))
          {
            echo'
              <li><a class="text-muted" href="'.site_url('monitor/accueil').'">Gestions Moniteur</a></li>
              <li><a class="text-muted" href="'.site_url('user/logout').'">Déconnexion</a></li>
            ';
          }else{
            echo'
              <li><a class="text-muted" href="'.site_url('user/signin').'">Connexion</a></li>
              <li><a class="text-muted" role="button" href="'.site_url('user/signup').'">Inscription</a></li>
            ';        
          }  
        ?>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5></h5>
        <ul class="list-unstyled text-small">
          <li><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Mentions Légales</button></li>
        </ul>
      </div>
    </div>     
    </footer>
    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
          <img class="m-2 circle container" src="<?= site_url('assets/picture/logoCastellane.png') ?>" alt="Erreur de chargement de l'image" width="250" height="250">
          </div>

          <!-- Modal body -->
          <div class="modal-body">
          <p>
            Le site www.Castellaneauto.com utilise Google Analytics, un service d'analyse de site internet fourni par Google Inc. (« Google »). <br>
            Google Analytics utilise des cookies , qui sont des fichiers texte placés sur votre ordinateur, pour aider le site internet à analyser l'utilisation du site par ses utilisateurs. <br>
            Les données générées par les cookies concernant votre utilisation du site (y compris votre adresse IP) seront transmises et stockées par Google sur des serveurs situés aux Etats-Unis. <br>
            Google utilisera cette information dans le but d'évaluer votre utilisation du site, de compiler des rapports sur l'activité du site à destination de son éditeur et de fournir d'autres services relatifs à l'activité du site et à l'utilisation d'Internet. <br>
            Google est susceptible de communiquer ces données à des tiers en cas d'obligation légale ou lorsque ces tiers traitent ces données pour le compte de Google, y compris notamment l'éditeur de ce site. <br>
            Google ne recoupera pas votre adresse IP avec toute autre donnée détenue par Google. Vous pouvez désactiver l'utilisation de cookies en sélectionnant les paramètres appropriés de votre navigateur. <br>
            Cependant, une telle désactivation pourrait empêcher l'utilisation de certaines fonctionnalités de ce site. En utilisant ce site internet, vous consentez expressément au traitement de vos données nominatives par Google dans les conditions et pour les finalités décrites ci-dessus.<br>

            Ce site (www.Castellaneauto.comr) est proposé en différents langages web (HTML, Javascript, CSS, etc…) pour un meilleur confort d’utilisation et un graphisme plus agréable, nous vous recommandons de recourir à des navigateurs modernes à jour comme Internet explorer, Safari, Firefox, Google Chrome, Microsoft Edge, Opéra …
          </p>
          <hr>
          <h5>Conditions d'utilisation</h5>
          <p>
            Le site www.Castellaneauto.com met en œuvre tous les moyens dont elle dispose, pour assurer une information fiable et une mise à jour fiable de ses sites internet.
            Toutefois, des erreurs ou omissions peuvent survenir. L’internaute devra donc s’assurer de l’exactitude des informations auprès du formulaire de contact, et signaler toutes modifications du site qu’il jugerait utile.
            n’est en aucun cas responsable de l’utilisation faite de ces informations, et de tout préjudice direct ou indirect pouvant en découler.
          </p>
          <hr>
          <h5>Liens hypertextes / Forum</h5>
          <p>
            Les sites internet peuvent offrir des liens vers d’autres sites internet ou d’autres ressources disponibles sur Internet.
            Castellane-Auto-Auto ne dispose d’aucun moyen pour contrôler les sites en connexion avec ses sites internet, ne répond pas de la disponibilité de tels sites et sources externes, ni de la garantit.
            Elle ne peut être tenue pour responsable de tout dommage, de quelque nature que ce soit, résultant du contenu de ces sites ou sources externes, et notamment des informations, produits ou services qu’ils proposent, ou de tout usage qui peut être fait de ces éléments.
            Les risques liés à cette utilisation incombent pleinement à l’internaute, qui doit se conformer à leurs conditions d’utilisation. Les utilisateurs, les abonnés et les visiteurs des sites internet ne peuvent pas mettre en place un hyperlien en direction de ce site sans l’autorisation expresse et préalable de Castellane-Auto.
            Dans l’hypothèse où un utilisateur ou visiteur souhaiterait mettre en place un hyperlien en direction d’un des sites internet de Castellane-Auto, il lui appartiendra d’adresser un email accessible sur le site afin de formuler sa demande de mise en place d’un hyperlien.
            Castellane-Auto se réserve le droit d’accepter ou de refuser un hyperlien sans avoir à en justifier sa décision.
          </p>
          <hr>
          <h5>Services fournis</h5>
          <p>
            L’ensemble des activités de la société ainsi que ses informations sont présentés sur notre site www.castellaneauto.fr.
            Castellane-Auto s’efforce de fournir sur le site www.castellaneauto.com des informations aussi précises que possible.
            les renseignements figurant sur le site www.castellaneauto.com ne sont pas exhaustifs et les photos non contractuelles.
            Ils sont donnés sous réserve de modifications ayant été apportées depuis leur mise en ligne.
            Par ailleurs, tous les informations indiquées sur le site www.castellaneauto.com sont données à titre indicatif, et sont susceptibles de changer ou d’évoluer sans préavis.
          </p>
          <hr>
          <h5>Limitation contractuelles sur les données</h5>
          <p>
            Les informations contenues sur ce site sont aussi précises que possible et le site remis à jour à différentes périodes de l’année, mais peut toutefois contenir des inexactitudes ou des omissions.
            Si vous constatez une lacune, erreur ou ce qui parait être un dysfonctionnement, merci de bien vouloir le signaler par email, à l’adresse castellaneAuto@gmail.com en décrivant le problème de la manière la plus précise possible (page posant problème, type d’ordinateur et de navigateur utilisé, …).
            Tout contenu téléchargé se fait aux risques et périls de l’utilisateur et sous sa seule responsabilité.
            En conséquence, ne saurait être tenu responsable d’un quelconque dommage subi par l’ordinateur de l’utilisateur ou d’une quelconque perte de données consécutives au téléchargement.
            De plus, l’utilisateur du site s’engage à accéder au site en utilisant un matériel récent, ne contenant pas de virus et avec un navigateur de dernière génération mis-à-jour.
            Les liens hypertextes mis en place dans le cadre du présent site internet en direction d’autres ressources présentes sur le réseau Internet ne sauraient engager la responsabilité de Castellane-Auto.
          </p>
          <hr>
          <h5>Litiges</h5>
          <p>
            Les présentes conditions du site www.castellaneauto.com sont régies par les lois françaises et toute contestation ou litiges qui pourraient naître de l’interprétation ou de l’exécution de celles-ci seront de la compétence exclusive des tribunaux dont dépend le siège social de la société.
            La langue de référence, pour le règlement de contentieux éventuels, est le français.
          </p>
          <hr>
          <h5>Données personnelles</h5>
          <p>
            De manière générale, vous n’êtes pas tenu de nous communiquer vos données personnelles lorsque vous visitez notre site Internet www.castellaneauto.com
            Cependant, ce principe comporte certaines exceptions. En effet, pour certains services proposés par notre site, vous pouvez être amenés à nous communiquer certaines données telles que : votre nom, votre fonction, le nom de votre société, votre adresse électronique, et votre numéro de téléphone.
            Tel est le cas lorsque vous remplissez le formulaire qui vous est proposé en ligne, dans la rubrique « votre avis nous interesse ».
            Dans tous les cas, vous pouvez refuser de fournir vos données personnelles. Dans ce cas, vous ne pourrez pas utiliser les services du site, notamment celui de solliciter des renseignements sur notre société, ou de recevoir les lettres d’information.
            Enfin, nous pouvons collecter de manière automatique certaines informations vous concernant lors d’une simple navigation sur notre site Internet, notamment : des informations concernant l’utilisation de notre site, comme les zones que vous visitez et les services auxquels vous accédez, votre adresse IP, le type de votre navigateur, vos temps d’accès. De telles informations sont utilisées exclusivement à des fins de statistiques internes, de manière à améliorer la qualité des services qui vous sont proposés. Les bases de données sont protégées par les dispositions de la loi du 1er juillet 1998 transposant la directive 96/9 du 11 mars 1996 relative à la protection juridique des bases de données.
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          </div>

        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
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
        $("#info").append('<div class="alert alert-danger"><strong>Attention ! </strong> Le quizz non opérationnel</div>');
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
    $("#question").append("<font size='5'>Question N°"+(currentQuestion+1)+"</font>: ");
    $("#question").append("\n<font size='4'>"+quiz[currentQuestion].question.question+" </font><br><br>");
    var reponses = "";
    for (var i=0;i<quiz[currentQuestion].reponses.length;i++) {
        reponses += "<div class='row'><div class='custom-control custom-radio col-sm-4 mb-3'><input type='radio' class='custom-control-input' id='"+quiz[currentQuestion].reponses[i].id+"' name='reponse' value='"+quiz[currentQuestion].reponses[i].id+"'><label class='custom-control-label' for='"+quiz[currentQuestion].reponses[i].id+"'>"+quiz[currentQuestion].reponses[i].reponse+"</label></div>";
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
