<template>
	<div class="detailwrap">
		<div class="detaill">
			<div v-html="datas"></div>
			<div class="geturl">
				已有 4 人下载过  需支付 1 金币<p class="getinfo" @click="geturlpass(id)">获取下载地址</p>
				<p class="infodetail" v-if="id==uid">百度云盘地址：<i class="infourl">{{urls}}</i>密码：<i class="infopas">{{pas}}</i></p>
			</div>
			
		</div>
	</div>
</template>
<script>

	export default{
		name:'Index',
		data(){
			return {
				datas:"",
				id:null,
				uid:'',
				urls:'',
				pas:''
			}
		},
		methods:{
			geturlpass(id){
				const self=this;
				this.axios.post('http://127.0.0.1/selfweba/index.php/Home/Index/geturlpas',{id:id})
				.then(function (response) {
				    self.uid=response.data.u_id;
				    self.urls=response.data.url;
				    self.pas=response.data.pas;
				})
				.catch(function (response) {
				    console.log(response);
				})
			}
		},
		created:function(){
			
			const self=this;
			var nid=this.$route.query.infoid;
			this.axios.get('http://127.0.0.1/selfweba/index.php/Home/Index/getdetail?infoid='+nid)
			  .then(function (response) {
			  	
			    self.datas=response.data.detail
			    self.id=response.data.id
			    console.log(self.datas)
			  })
			  .catch(function (response) {
			    console.log(response);
			  })
		}
		
		
	}
</script>

<style scoped="" lang="scss">
	.detailwrap{
		width:1500px;
		margin:auto;
		
		.detaill{
			width:900px;
			background:#fff;
			border-radius: 5px;
			.geturl{
				background: #ffffff;
			    line-height: 58px;
			    font-size: 18px;
			    text-indent: 2em;
			    font-weight: 600;
			    position: relative;
			    color:#c78686;
			    .getinfo{
			    	position: absolute;
				    right: 19px;
				    top: 0px;
				    cursor: pointer;
				    text-indent: 0;
				    color:#000;
			    }
			    .infodetail{
			    	color:#000;
			    	border-top: 1px solid #decccc;
			    	.infourl{
				    	margin-right:50px;
				    	color:#734c4c;
				    }
				    .infopas{
				    	color:#734c4c
				    }
			    }
			    
			}
		}
	}
</style>