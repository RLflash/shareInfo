<template>
  <div class="createPost-container">
    <el-form class="form-container" :model="postForm" :rules="rules" ref="postForm">

      <sticky :className="'sub-navbar '+postForm.status">
        <template>
          <el-button v-loading="loading" style="margin-left: 10px;" type="success" @click="submitForm()">发布
          </el-button>
        
        </template>
        <!--<template v-else>
          <el-tag>发送异常错误,刷新页面,或者联系程序员</el-tag>
        </template>-->

      </sticky>

      <div class="createPost-main-container">
        <el-row>
          <el-col :span="21">
          	  <div class="postInfo-container">
              <el-row>
                <!--<el-col :span="8">
                  <el-form-item label-width="45px" label="作者:" class="postInfo-container-item">
                    <multiselect v-model="postForm.author" :options="userLIstOptions" @search-change="getRemoteUserList" placeholder="搜索用户" selectLabel="选择"
                      deselectLabel="删除" track-by="key" :internalSearch="false" label="key">
                      <span slot='noResult'>无结果</span>
                    </multiselect>
                  </el-form-item>
                </el-col>-->
                <el-col :span="8">
                  <el-tooltip class="item" effect="dark" content="第一导航内容" placement="top">
                    <el-form-item label-width="100px" label="第一等级:" class="postInfo-container-item">
                      <el-input placeholder="第一级" style='min-width:150px;' v-model="postForm.oneleave">
                      </el-input>
                    </el-form-item>
                  </el-tooltip>
                </el-col>
								<el-col :span="8">
                  <el-tooltip class="item" effect="dark" content="第二导航内容" placement="top">
                    <el-form-item label-width="100px" label="第二等级:" class="postInfo-container-item">
                      <el-input placeholder="第二级" style='min-width:150px;' v-model="postForm.twoleave">
                      </el-input>
                    </el-form-item>
                  </el-tooltip>
                </el-col>
               
              </el-row>
            </div>
 						<el-form-item style="margin-bottom: 40px;" label-width="100px" label="标题:">
		          <el-input type="textarea" class="article-textarea" :rows="1" autosize placeholder="请输入内容" v-model="postForm.title">
		          </el-input>
	          	<span class="word-counter" v-show="contentShortLength">{{contentShortLength}}字</span>
        		</el-form-item>
            <el-form-item style="margin-bottom: 40px;" label-width="100px" label="百度云地址:">
		          <el-input type="textarea" class="article-textarea" :rows="1" autosize placeholder="请输入内容" v-model="postForm.panurl">
		          </el-input>
	          	<span class="word-counter" v-show="panurls">{{panurls}}字</span>
        		</el-form-item>
        		<el-form-item style="margin-bottom: 40px;" label-width="100px" label="百度云密码:">
		          <el-input type="textarea" class="article-textarea" :rows="1" autosize placeholder="请输入密码" v-model="postForm.panpas">
		          </el-input>
	          	<span class="word-counter" v-show="panpass">{{panpass}}字</span>
        		</el-form-item>
          </el-col>
        </el-row>
    	</div>

    </el-form>
   	<div id="editor"></div>  
    <!--<ue style="width:1000px;height: 100px;margin-left:100px"></ue>-->
		<!--<div id="container" ></div>-->
  </div>
</template>

<script>
//import ue from '@/components/Editer/editer'
import Upload from '@/components/Upload/singleImage3'
import MDinput from '@/components/MDinput'
import Multiselect from 'vue-multiselect'// 使用的一个多选框组件，element-ui的select不能满足所有需求
import 'vue-multiselect/dist/vue-multiselect.min.css'// 多选框组件css
import Sticky from '@/components/Sticky' // 粘性header组件

import { uploadart } from '@/api/art'

const defaultForm = {
	title: '', // 文章摘要
  content: '', // 文章内容
  oneleave:'',//第一等级
	twoleave:'',//第二等级
	panurl:'',//云盘地址
	panpas:'',//云盘密码
}

export default {
  name: 'articleDetail',
  components: {MDinput, Upload, Multiselect, Sticky },
  props: {
    isEdit: {
      type: Boolean,
      default: false
    }
  },
  data() {
   
    return {
      postForm: Object.assign({}, defaultForm),
      fetchSuccess: true,
      loading: false,
      userLIstOptions: [],
    	editor: null  
    }
  },
  computed: {
    contentShortLength() {
      return this.postForm.title.length
    },
    panurls(){
    	return this.postForm.panurl.length
    },
     panpass(){
    	return this.postForm.panpas.length
    }
  },
   mounted() {
     const _this = this;  
       
      this.editor = UE.getEditor('editor', {   
            BaseUrl: '',   
          UEDITOR_HOME_URL: '/static/utf8-php/', //这个是静态资源的路径  
        //  UEDITOR_HOME_URL:'/static/utf8-php/',
           //  toolbars:[]  //编辑器里需要用的功能  
          }); // 初始化UE  
     
    },
  created() {

    if (this.isEdit) {
      this.fetchData()
    } else {
      this.postForm = Object.assign({}, defaultForm)
    }
  },
  methods: {
    fetchData() {
      fetchArticle().then(response => {
        this.postForm = response.data
      }).catch(err => {
        this.fetchSuccess = false
        console.log(err)
      })
    },
    submitForm() {
     	 if (this.postForm.oneleave.length === 0) {
        this.$message({
          message: '请填写第一等级',
          type: 'warning'
        })
        return
      }
     	  if (this.postForm.twoleave.length === 0) {
        this.$message({
          message: '请填写第二等级',
          type: 'warning'
        })
        return
      }
     	   if (this.postForm.title.length === 0) {
        this.$message({
          message: '请填写标题',
          type: 'warning'
        })
        return
      }
     if (this.postForm.panurl.length === 0) {
        this.$message({
          message: '请填云盘url',
          type: 'warning'
        })
        return
      }
      if (this.postForm.panpas.length === 0) {
        this.$message({
          message: '请填写云盘密码',
          type: 'warning'
        })
        return
      }
      this.$refs.postForm.validate(valid => {
      	
        if (valid) {
        	const tit=this.postForm.title
					//const cont=this.postForm.content
					const cont=this.editor.getContent()
					console.log(cont)
					const oneleave=this.postForm.oneleave
					const twoleave=this.postForm.twoleave
					const urlpan=this.postForm.panurl
					const paspan=this.postForm.panpas
        	  uploadart(tit,cont,oneleave,twoleave,urlpan,paspan).then(response => {
		   			
		          this.loading = true
		          this.$notify({
		            title: '成功',
		            message: '发布文章成功',
		            type: 'success',
		            duration: 2000
		          })
		          this.postForm.status = 'published'
		          this.loading = false
		        }) 
        }else {
		          console.log('error submit!!')
		          return false
		        }
	      	})
		    
    },

   
   
  }
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
  @import "src/styles/mixin.scss";
  .title-prompt{
    position: absolute;
    right: 0px;
    font-size: 12px;
    top:10px;
    color:#ff4949;
  }
  .createPost-container {
    position: relative;
    .createPost-main-container {
      padding: 40px 45px 20px 50px;
      .postInfo-container {
        position: relative;
        @include clearfix;
        margin-bottom: 10px;
        .postInfo-container-item {
          float: left;
        }
      }
      .editor-container {
        min-height: 500px;
        margin: 0 0 30px;
        .editor-upload-btn-container {
            text-align: right;
            margin-right: 10px;
            .editor-upload-btn {
                display: inline-block;
            }
        }
      }
    }
    .word-counter {
      width: 40px;
      position: absolute;
      right: -10px;
      top: 0px;
    }
  }
</style>

