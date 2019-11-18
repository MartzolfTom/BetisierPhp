<?php
$db = new Mypdo();
$managerCitation = new CitationManager($db);
$managerVote = new VoteManager($db);


if (empty($_POST['note_citation'])) {
?>


	<h1> Noter citation </h1>
	<table>
   <tr>
     <th>Nom de l'enseignant</th>
     <th>Libellé</th>
		 <th>Date</th>
  </tr>
  <?php

$citation = $managerCitation->getDetailCitation($_GET['cit_num']);
    ?>
    <tr>
      <td> <?php echo $citation->getCitPersonneCit(); ?> </td>
      <td> <?php echo $citation->getCitLibelle(); ?> </td>
			<td> <?php echo $citation->getCitDate(); ?> </td>
    </tr>
  </table>


    <form method ="post" action ="#">

      Note : <input type="number" name="note_citation" value="10"/>
          <input type="submit" name="Valider" />
    </form>

    <?php

  }else{


    $tab = array( 'cit_num' => $_GET['cit_num'],
                  'per_num' => 77,            // temporaire
                  'vot_valeur' => $_POST['note_citation']);

    $vote = new Vote($tab);

    $managerVote->ajouterNote($vote);
    echo "La note a été ajouté";


  } ?>
