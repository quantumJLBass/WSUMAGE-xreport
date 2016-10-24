<?php

class Wsu_Xreports_Block_Adminhtml_Report_Guestreport_Renderer_Item extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $id = $row->getData('entity_id');


		$finalResult = array();
		$model = Mage::getModel('sales/order')->load($id);

		$html="";
		// Loop through all items in the cart
		foreach ($model->getAllVisibleItems() as $item) {
		    //$product = $item->getProduct();
		  // Array to hold the item's options
		  $result = array();
		  // Load the configured product options
		  $options = $item->getProductOptions();
          //var_dump($options);
		  //$finalResult = array_merge($finalResult, $options);
		  // Check for options
		  if (isset($options['info_buyRequest'])){
			$info = $options['info_buyRequest'];
			if (isset($info['options'])){
				$result = array_merge($result, $info['options']);
			}
			if (isset($info['options']['additional_options'])){
				$result = array_merge($result, unserialize($info['options']['additional_options']) );
			}
			if (!empty($info['attributes_info'])){
				$result = array_merge($info['attributes_info'], $result);
			}
		  }
		  $finalResult = array_merge($finalResult, $result);
		}
        //var_dump($finalResult);
		$csv_export = Mage::registry('csv_export');
		//var_dump($csv_export);
		if($csv_export==true){

			$options=array();
			$guestkeyarray=array();
			$guestarray=array();
			foreach ($finalResult as $_option){
				$label = trim($this->escapeHtml($_option['label']));
				$value = trim($_option['value']);
				if ( $value!=="" && $label!=="" && strpos($label,'guest_')===false ){
					$options[]=$label.':'.$value;
				}
				if ( $label!=="" && strpos($label,'guest_')!==false && strpos($label,'_{%d%}_')===false ){
					preg_match('/_(?<digit>\d+)_/',$label, $matches);
					$guestkeyarray[]=trim($matches[0],'_');
					$guestarray[$label]=$value;
				}
			}

			$guestkeyarray=array_unique($guestkeyarray);

			foreach ($guestkeyarray as $_opkey){
				$firstname = isset($guestarray["guest_${_opkey}_firstName"])?$guestarray["guest_${_opkey}_firstName"]:"";
				$lastname = isset($guestarray["guest_${_opkey}_lastName"])?$guestarray["guest_${_opkey}_lastName"]:"";
				$options[]="Guest ${_opkey}:".$firstname." ".$lastname;
			}
			$html = implode(",\r\n", $options);
			//$html = '"'.$str.'"';
		}else{







		ob_start();
   ?><?php if (!empty($finalResult)):?>



					<?php
                    //var_dump($finalResult);die();
					$options=array();
					foreach ($finalResult as $_option){
						$options[]=$_option;
					}

					if(!empty($options)):
					?>



                	<h4><?=$this->__('Your options')?></h4>
                    <dl>
                        <?php foreach ($options as $_option) :
                        $label = "";
                        if( isset($_option['label']) ){
                            $label = trim($this->escapeHtml($_option['label']));
                        }
						$value = "";
                        if( isset($_option['value']) ){
                            $value = trim($_option['value']);
                        }
						if ( $value!=="" ): //&& $label!=="" && strpos($label,'guest_')===false ?>
                            <dt><?php
								if(strpos($label,'firstName')!==false){
									echo "First Name:";
								}elseif(strpos($label,'lastName')!==false){
									echo "Last Name:";
								}elseif(strpos($label,'dietary')!==false){
									echo "Dietary Choice:";
								}elseif(strpos($label,'meal')!==false){
									echo "Meal Choice:";
								}elseif(strpos($label,'mobility')!==false){
									echo "Mobility Requirements:";
								}elseif(strpos($label,'requested_seating')!==false){
									echo "Seating Request:";
								}
							 ?></dt>
                            <dd><?=$_option['value']?></dd>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
					<?php endif;?>
                <?php endif;?>
                <?php if (!empty($finalResult)):?>
					<?php
					$options=array();
					foreach ($finalResult as $_option){
                        $label = "";
                        if( isset($_option['label']) ){
                            $label = trim($this->escapeHtml($_option['label']));
                        }
						$value = "";
                        if( isset($_option['value']) ){
                            $value = trim($_option['value']);
                        }
						if ( $label!=="" ){ // && strpos($label,'guest_')!==false && strpos($label,'_{%d%}_')===false
							$options[]=$_option;
						}
					}
					if(!empty($options)):
					?>
					<h4><?=$this->__('Guest list')?></h4>
                    	<?php $i=1; ?>
                        <?php foreach ($options as $_option) : ?>
							<?php //$_formatedOptionValue = $this->getFormatedOptionValue($_option) ?>
                            <?php
                            $label = trim($this->escapeHtml($_option['label']));
                            $value = trim($_option['value']);
                            if ( $label!=="" ): //&& strpos($label,'guest_')!==false && strpos($label,'_{%d%}_')===false
									 ?>
							<?php
								if(strpos($label,'guest_'.$i.'_')!==false){
									if($i>0){
										echo "</dl>";
									}
									echo "Guest ".$i."<dl>";
									$i++;
								}
							 ?>
								 <?php if ( $value!=="" ): ?>
                                    <dt><?php

                                        if(strpos($label,'firstName')!==false){
                                            echo "First Name:";
                                        }elseif(strpos($label,'lastName')!==false){
                                            echo "Last Name:";
                                        }elseif(strpos($label,'dietary')!==false){
                                            echo "Dietary Choice:";
                                        }elseif(strpos($label,'meal')!==false){
                                            echo "Meal Choice:";
                                        }elseif(strpos($label,'mobility')!==false){
                                            echo "Mobility Requirements:";
                                        }elseif(strpos($label,'requested_seating')!==false){
                                            echo "Seating Request:";
                                        }
                                     ?></dt>
                                    <dd><?=$_option['value']?></dd>
                                 <?php endif; ?>
                        	<?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
					<?php endif;?>
                <?php endif;?>
		<?php

		$html .= ob_get_clean();
		}
        return $html;
    }

}
