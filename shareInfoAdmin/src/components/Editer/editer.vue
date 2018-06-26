<template>  
  <div>  
    <div id="editor"></div>  
    <div @click="getUEContent">ee</div>
  </div>  
</template>  
<script>  

  export default {  
    name: 'UE',  
    data () {  
      return {  
        editor: null  
      }  
    },  
    mounted() {  
      const _this = this;  
       
      this.editor = UE.getEditor('editor', {   
            BaseUrl: '',   
          //UEDITOR_HOME_URL: 'http://localhost/selfwebadmin/static/utf8-php/', //这个是静态资源的路径  
          UEDITOR_HOME_URL:'/static/utf8-php/',
            // toolbars:[]  //编辑器里需要用的功能  
          }); // 初始化UE  
     
      
    },  
    methods: {  
      getUEContent() { // 获取内容方法  
      //  return this.editor.getContent() 
      console.log(this.editor.getContent())
      },  
//    testMsg(){  
//      const _this = this;  
////      this.defaultMsg = this.text;  
////      console.log(this.defaultMsg);  
////      this.editor.setContent(this.defaultMsg); // 确保UE加载完成后，放入内容。  
//    }  
    },
//  watch : {  
//    'text' : 'testMsg'  
//  },  
//  props : ['text'], //接收传过来的文章  
    destroyed() {  
      this.editor.destroy();  
    }  
  }  
</script>  
<style type="text/css">  
  /*#editor{height: 500px;}*/  
</style>  
