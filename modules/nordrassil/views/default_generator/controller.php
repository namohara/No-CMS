&lt;?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of {{ controller_name }}
 *
 * @author No-CMS Module Generator
 */
class {{ controller_name }} extends CMS_Controller {

	public function index(){
		
		// initialize groceryCRUD
        $crud = new grocery_CRUD();
        
        // set model
        $crud->set_model('{{ directory }}/data/{{ controller_name }}_model');
        
        // adjust groceryCRUD's language to No-CMS's language
        $crud->set_language($this->cms_language());
        
        // table name
        $crud->set_table('{{ table_name }}');
        
        // set subject
        $crud->set_subject('{{ table_caption }}');
        
        // displayed columns on list
        $crud->columns({{ field_list }});
        // displayed columns on edit operation
        $crud->edit_fields({{ field_list }});
        // displayed columns on add operation
        $crud->add_fields({{ field_list }});
        
        // caption of each columns
{{ display_as }}

		/** HINT: Put set relation (lookup) codes here 
		 * (documentation: http://www.grocerycrud.com/documentation/options_functions/set_relation)
		 * eg: 
		 * 		$crud->set_relation( $field_name , $related_table, $related_title_field , $where , $order_by );
		**/
{{ set_relation }}

		/** HINT: Put set relation_n_n (detail many to many) codes here 
		 * (documentation: http://www.grocerycrud.com/documentation/options_functions/set_relation_n_n)
		 * eg: 
		 * 		$crud->set_relation_n_n( $field_name, $relation_table, $selection_table, $primary_key_alias_to_this_table, 
		 * 			$primary_key_alias_to_selection_table , $title_field_selection_table, $priority_field_relation );
		**/
{{ set_relation_n_n }}
		
		/** HINT: Put custom field type here
		 * (documentation: http://www.grocerycrud.com/documentation/options_functions/field_type)
		 * eg: 
		 * 		$crud->field_type( $field_name , $field_type, $value  );
		**/
{{ hide_field }}
		
		/** HINT: Put callback here
		 * (documentation: httm://www.grocerycrud.com/documentation/options_functions)
		 */
		$crud->callback_before_insert(array($this,'before_insert'));
		$crud->callback_before_update(array($this,'before_update'));
		$crud->callback_before_delete(array($this,'before_delete'));
		$crud->callback_after_insert(array($this,'after_insert'));
		$crud->callback_after_update(array($this,'after_update'));
		$crud->callback_after_delete(array($this,'after_delete'));
		// callback for one to many detail columns
{{ detail_callback_call }}        
        
        // render
        $output = $crud->render();
        $this->view("grocery_CRUD", $output, "{{ navigation_name }}");
        
    }
    
    public function before_insert($post_array){
		return TRUE;
	}
	
	public function after_insert($post_array, $primary_key){
		$this->after_insert_or_update($post_array, $primary_key);
		return TRUE;
	}
	
	public function before_update($post_array, $primary_key){
		return TRUE;
	}
	
	public function after_update($post_array, $primary_key){
		$this->after_insert_or_update($post_array, $primary_key);
		return TRUE;
	}
	
	public function before_delete($primary_key){
{{ detail_before_delete }}
		return TRUE;
	}
	
	public function after_delete($primary_key){
		return TRUE;
	}
	
	public function after_insert_or_update($post_array, $primary_key){
{{ detail_after_insert_or_update }}		
	}

{{ detail_callback_declaration }}
    
}

?&gt;
