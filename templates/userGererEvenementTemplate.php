<?php

	for($i=0; $i<"$taille"; $i++){
		
		echo "
			<div class='evenement'>
				<table>		
					<colgroup>
						<col span='1' width='200' style='background-color:#B8C7D3' />
						<col span='1' width='150' style='background-color: #CCCCCC' />
					</colgroup>
				   
					<thead>
						<tr>
							<th colspan='2'>
							
								${'nomEvenement'.$i}
								
							</th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<td rowspan='4'>Image</td>
							<td>";

									if(!isset( ${'dateFermeture'.$i} )){
										echo "Du ${'dateOuverture'.$i} <br>au ${'dateFermeture'.$i}";
									}
									else{
										echo "Le ${'dateOuverture'.$i}";
									}					
			echo "
							</td>
						</tr>
						<tr>
							<td>

									${'image'.$i}

							</td>
						</tr>
						<tr>
							<td>

									${'type'.$i}

							</td>
						</tr>
						<tr>
							<td>

									Statut : 
								";
									if(${'statut'.$i}==0){
										echo 'Public';
									}
									else{
										echo 'Privé';
									}
			echo "
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		";
		
	}
	
?>

