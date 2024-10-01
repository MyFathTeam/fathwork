<template> 
    <FormAction 
    :pre-requisites="true" 
        @setPreRequisites="setPreRequisites" 
        :init-url="initUrl" 
        :init-form="initForm" 
        :form="form" 
        redirect="Category" 
    > 
        <div class="grid grid-cols-2 gap-6"> 
            <div class="col-span-2"> 
                <BaseInput 
                    type="text" 
                    v-model="form.title" 
                    name="title" 
                    :label=" 
                        $trans('master.category.props.title') 
                    " 
                    v-model:error="formErrors.title" 
                    autofocus 
                /> 
            </div> 
             
        </div> 
         
    </FormAction> 
</template> 
 
<script> 
export default { 
    title: 'CategoryForm' 
} 
</script> 
 
<script setup> 
import { reactive } from "vue"; 
import { getFormErrors } from "@core/helpers/action" 
 
const initUrl = "master/category/" 
const formErrors = getFormErrors(initUrl) 
const preRequisites = reactive({}) 
 
const initForm = { 
    title: "", 
}; 
 
const form = reactive({ ...initForm }); 
const setPreRequisites = (data) => { 
    Object.assign(preRequisites, data) 
} 
</script>