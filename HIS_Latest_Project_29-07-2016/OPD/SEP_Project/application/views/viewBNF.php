  <!-- Script to load the pdf -->
        <script>
		function previewUrl(url,target){
			//use timeout coz mousehover fires several times
			clearTimeout(window.ht);
			window.ht = setTimeout(function(){
				var div = document.getElementById(target);
				div.innerHTML = '<iframe style="width:100%;height:80%;" frameborder="0" src="' + url + '" />';
			},20);
				event.preventDefault();
		} 
                function goToPage(){
			
                         myTextField = document.getElementById('txtPagenum').value;
                        //alert(myTextField);
                         temp=20;
                         pageNumber =+ myTextField+temp;
						
                        if( myTextField != "" && !isNaN(pageNumber)){
                          //alert("You entered: " + pageNumber);
                          var pre = "<?php  echo base_url('/assets/bnf/')?>"+'/';
                          var post  = 'BNF 66.pdf#page='+pageNumber;
                          console.log(pre+post);
                          previewUrl(pre+post ,'pdfDiv');
                         
                        
                        }
                        else
                            alert("Would you please enter some text?");
                        
                        
        //  previewUrl('BNF 66.pdf#page='+number,'pdfDiv');
		}  
                
	</script>


                  <div class="modal-content" style="height: 95%;" >
      	            <div class="modal-header">        	       
        	       <h4 class="modal-title" id="myModalLabel">Refer BNF Prescribe Conveniently</h4>
      		    </div>
                      
                      <div class="modal-body" >
                        <div style="float:left;width:25%">                                                        
                            <div style="overflow: auto; width: 100%; height: 450px; padding-right: 3px;">
                                
                            <div class="panel-group" id="accordion">
                                
                                 <!--Starting point of Category 1-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        1.Gastro-intestinal system
                                      </a>
                                    </h4>
                                  </div>                                   
                                  <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=64'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.1 Dyspepsia and gastro-oesophageal reflux disease</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=68'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.2 Antispasmodics and other drugs altering gut</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=70'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.3 Antisecretory drugs and mucosal protectants</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=78'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.4 Acute diarrhoea</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=81'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.5 Chronic bowel disorders</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=88'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.6 Laxatives</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=98'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.7 Local preparations for anal and rectal disorders</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=100'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.8 Stoma care</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=100'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">1.9 Drugs affecting intestinal secretions</a><br>
                                    </div>
                                  </div>                                    
                                </div>
                                 
                                 <!--Starting point of Category 2-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        2.Cardiovascular system
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=103'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.1 Positive inotropic drugs</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=105'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.2 Diuretics</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=113'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.3 Anti-arrhythmic drugs</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=120'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.4 Beta-adrenoceptor blocking drugs</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=127'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.5 Hypertension and heart failure</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=147'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.6 Nitrates, calcium-channel blockers, and other antianginal drugs</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=160'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.7 Sympathomimetics</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=163'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.8 Anticoagulants and protamine</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=175'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.9 Antiplatelet drugs</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=181'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.10 Stable angina, acute coronary syndromes, and fibrinolysis</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=186'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.11 Antifibrinolytic drugs and haemostatics</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=188'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.12 Lipid-regulating drugs</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=196'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">2.13 Local sclerosants</a><br>
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 3-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        3.Respiratory system
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=197'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.1 Bronchodilators</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=212'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.2 Corticosteroids</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=218'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.3 Cromoglicate and related therapy, leukotriene receptor antagonists,and phosphodiesterase type-4 inhibitor</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=220'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.4 Antihistamines,hyposensitisation, and allergic emergencies</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=229'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.5 Respiratory stimulants and pulmonary surfactants</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=230'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.6 Oxygen</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=232'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.7 Mucolytics</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=234'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.8 Aromatic inhalations</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=234'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.9 Cough preparations</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=236'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.10 Systemic nasal decongestants</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=236'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">3.11 Antifibrotics</a><br>
                                        
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 4-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        4.Central Nervous System
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=238'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.1 Hypnotics and anxiolytics</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=247'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.2 Drugs used in psychoses and related disorders</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=264'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.3 Antidepressant drugs</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=277'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.4 CNS stimulanta and drugs used for attention deficit hyperactivity</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=281'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.5 Drugs used in the treatment of obesity</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=282'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.6 Drugs used in vertigo</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=289'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.7 Analgesics</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=312'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.8 Antipileptic drugs</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=332'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.9 Drugs used in parkinsonism and related disorders</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=345'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.10 Drugs used in substance dependence</a><br>
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=355'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">4.11 Drugs used in dementia</a><br>
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 5-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        5. Infections
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=359'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">5.1 Antibacterial drugs</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=416'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">5.2 Antifungal drugs</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=424'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">5.3 Antiviral drugs</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=447'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">5.4 Antiprotozoal drugs</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=460'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">5.5 Anthelmintics</a><br>
                                     </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 6-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                        6. Endocrine System
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseSix" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=463'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">6.1 Drugs used in diabetes</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=487'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">6.2 Thyroid and antithyroid drugs</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=490'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">6.3 Corticosteroids</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=496'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">6.4 Sex hormones</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=509'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">6.5 Hypothalamic and pituitary hormones and anti-oestrogens</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=516'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">6.6 Drugs affecting bone metabolism</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=525'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">6.7 Other endocrine drugs</a><br>
                                      
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 7-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                                        7. Obstetrics,Gynaecology and Urinary Tract Disorders
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseSeven" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=532'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">7.1 Drugs used in obstetrics</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=537'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">7.2 Treatment of vaginal and vulval conditions</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=540'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">7.3 Contraceptives</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=554'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">7.4 Drugs for genito-urinary disorders</a><br>
                                      </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 8-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                                        8. Malignant disease and immunosuppression
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseEight" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=566'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">8.1 Cytotoxic drugs</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=612'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">8.2 Drugs affecting the immune response</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=630'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">8.3 Sex hormones and hormone antagonists in malignant disease</a><br>
                                     
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 9-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                                        9. Nutrition and Blood
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseNine" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page==640'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.1 Anaemias and some other blood disorders</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=658'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.2 Fluids and electrolytes</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=666'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.3 Intravenous nutrition</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=672'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.4 Oral nutrition</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=973'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.5 Minerals</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=680'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.6 Vitamins</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=687'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.7 Bitters and tonics</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=687'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">9.8 Metabolic disorders</a><br>
                                     
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 10-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
                                        10.Musculoskeletal and joint diseases
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseTen" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=694'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">10.1 Drugs used in rheumatic diseases and gout</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=724'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">10.2 Drugs used in neuromuscular disorders</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=729'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">10.3 Drugs for the treatment of soft-tissue disorders and topical pain relief</a><br>

                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 11-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseElevan">
                                        11. Eye
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseElevan" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=733'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.1 Administration of drugs to the eye</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=734'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.2 Control of microbial contamination</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=734'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.3 Anti-infective eye preparations</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=737'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.4 Corticosteroids and other anti-inflammatory preparations</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=741'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.5 Mydriatics and cycloplegics</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=742'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.6 Treatment of glaucoma</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=747'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.7 Local anaesthetics</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=748'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.8 Miscellaneous ophthalmic preparations</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=754'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">11.9 Contact lenses</a><br>
                                       
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 12-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTweleve">
                                        12. Ear,Nose and oropharynx
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseTweleve" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=756'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">12.1 Drugs acting on the ear</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=759'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">12.2 Drugs acting on the nose</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=764'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">12.3 Drugs acting on the oropharynx</a><br>
                                     </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 13-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen">
                                        13. Skin
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseThirteen" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=771'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.1 Management of skin conditions</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=772'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.2 Emollient and barrier preparations</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=777'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.3 Topical local anaesthetics and antipruritics</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=778'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.4 Topical corticosteroids</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=786'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.5 Preparations for eczema and psoriasis</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=796'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.6 Acne and rosacea</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=801'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.7 Preparations for warts and calluses</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=802'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.8 Sunscreens and camouflagers</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=805'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.9 Shampoos and other preparations for scalp and hair conditions</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=806'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">13.10 Anti-infective skin preparations</a><br>

                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 14-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen">
                                        14. Immunological products and vaccines
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseFourteen" class="panel-collapse collapse">
                                    <div class="panel-body">
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=818'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">14.1 Active immunity</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=821'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">14.2 Passive immunity</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=821'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">14.3 Storage and use</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=821'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">14.4 Vaccines and antisera</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=841'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">14.5 Immunoglobulins</a><br>
                                     <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=846'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">14.6 International travel</a><br>
 
                                    </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of Category 15-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen">
                                        15.Anasthesia
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseFifteen" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=848'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">15.1 General Anaesthesia</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=865'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">15.2 Local Anaesthesia</a><br>
 
                                        
                                       </div>
                                  </div>
                                </div>
                                 
                                 <!--Starting point of index-->
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseSixteen">
                                        Refer Index
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseSixteen" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1081'); ?>" onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">A</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1086'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">B</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1088'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">C</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1093'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">D</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1096'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">E</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1098'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">F</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1100'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">G</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1102'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">H</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1104'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">I</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1106'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">J</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1106'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">K</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1107'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">L</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1108'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">M</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1112'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">N</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1114'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">O</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1115'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">P</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1120'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">Q</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1120'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">R</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1121'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">S</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1124'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">T</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1127'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">U</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1127'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">V</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1129'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">W</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1129'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">X</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1129'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">Y</a><br>
                                       <a href="<?php  echo base_url('/assets/bnf/BNF 66.pdf#page=1130'); ?>"  onmouseover="previewUrl(this.href,'pdfDiv')" onclick="previewUrl(this.href,'pdfDiv')">Z</a><br>
                                       
                                    </div>
                                  </div>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                        
                        <!--Ending point of left div-->
                           <div style="float:right;width:75%;height: 85%"> 
                               <input type="text" id="txtPagenum" class="txt" placeholder="Enter a page number" style="margin-left: 5px">
                               <button id="btnPagenum" type="button" class="btn btn-default" onclick="goToPage();">Go to page >></button>
                                <div id="pdfDiv" style="height: 600px; margin-top: 5px">

                                    <!--This is the div which loads BNF PDF-->
                                    
                                </div>
                            </div>
                    </div> <!--Ending of modal-->
                      
                      <div class="modal-footer" style="float: left;" >
			 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>			 					
                    </div>
                      
                      </div>
<!--          <script>
                            $("#txtPagenum").keypress(function(e) {
                                if(e.which == 13) {
                                    
                                  goToPage();
                                }
                            });
       </script>             -->