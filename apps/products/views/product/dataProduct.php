<script>
$(document).ajaxSuccess(function( event, xhr, settings ) {

	try{
		adobe.target.getOffer({  
		  "mbox": "target-global-mbox", 
		  "params" : { 
			  "entity.id": "<?php echo $this->af->product['product_id']; ?>", 
			  "entity.categoryId": "mobile phones",
			  "entity.name": "<?php echo $this->af->product['product_name']; ?>",
			  "entity.thumbnailUrl":"<?php echo imgFolder.$this->af->product['image_url'];?>",
		  	  "entity.value":"<?php echo $this->af->product['price']; ?>",
		  	  "entity.inventory":<?php echo $this->af->product['inventory']; ?>,
		  	  "entity.message":"<?php echo $this->af->product['message']; ?>",
		  	  "entity.brand":"<?php echo $this->af->product['brand']; ?>",
			  "entity.pageUrl": document.URL
		  },
		  "success": function(offers) {          
		        adobe.target.applyOffer( { 
		           "mbox": "target-global-mbox",
		           "offer": offers 
		        } );
		  },  
		  "error": function(status, error) {          
		      if (console && console.log) {
		        console.log(status);
		        console.log(error);
		      }
		  },
		 "timeout": 5000
		});
		  
		}catch(error){
		  console.log(error);
		}
  
});
</script>