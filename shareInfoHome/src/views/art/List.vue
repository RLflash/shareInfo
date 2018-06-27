<template>
	<div class="list">
		<ul>
			<li v-for="listitem in listInfos">	
				<router-link :to="{path:'/detail',query:{infoid:listitem.id}}">
					<div class="imglogo">
						<!--<img src="../assets/img/1.jpg" alt="" />-->
					</div>
					<div class="cont">
						<div class="title">{{listitem.title}}</div>
						<div class="detail">
							<p>发布者：{{listitem.autor}}</p>
							<p class="time">发布时间：{{listitem.createtime}}</p>
							<p class="liulan"><i class="myicon-liulan"></i>111</p>
							<p class="liuyan"><i class="myicon-liuyan"></i>222</p>
						</div>
					</div>
				</router-link>
			</li>
		
		</ul>
	</div>
</template>

<script>
	export default{
		name:'Nav',
		data(){
			return{
				listInfos:[1,2]
			}
		},	
		methods:{
			getInfof:function(name,leava){
				var self=this
				this.axios.get('Index/getInfot?all='+name+'&lea='+leava)
				.then(function(response){
					 self.listInfos=response.data
				})
				
			}
		},
		created:function(){
			var self=this;
			if(this.$route.query.name==undefined){
				self.getInfof(this.$route.query.kinds,0)
			}else{
				self.getInfof(this.$route.query.name,1)
			}
			
		},
		watch:{  
			$route(to,from){   
				var self=this
		        if(self.$route.query.name==undefined){
					self.getInfof(self.$route.query.kinds,0)
				}else{
					self.getInfof(self.$route.query.name,1)
				}
		    }
		}
	}
</script>
<style lang="scss" scoped>
	.list{
		width:1200px;
		margin:auto;
		background:#fff;
		padding:20px;
		li{
			clear: both;
			padding:21px;
			border-bottom: 1px solid #c5c5c5;
			cursor:pointer; 
			&:last-child{
				border:none
			}
			.imglogo,.cont{
				display: inline-block;
				vertical-align:middle
			}
			.cont{
				margin-left:10px;
				.title{
					font-size: 18px;
	    			font-weight: 600;
				}
				.detail{
					clear: both;
				    margin-top: 5px;
					clear: both;
					p{
						float:left;
					}
					.time{
						margin-left:20px;
						color:#999;
					}
					i{
						margin-left:20px;
						font-size: 26px;
						vertical-align: middle;
						margin-right: 3px;
					}
					.liulan{
						margin-left:100px
					}
				}
			}
		}
	}
</style>
