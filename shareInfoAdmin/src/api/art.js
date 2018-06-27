import request from '@/utils/request'
//发布文章
export function uploadart(title,content,oneleave,twoleave,urlpan,paspan) {
  const data = {
    title,
    content,
    oneleave,
    twoleave,
    urlpan,
    paspan
  }
  return request({
    url: 'Admin/Index/inserart',
    method: 'post',
    data
  })
}
//文章操作
export function fetchList(query) {
  return request({
    url: 'Admin/Index/seachinfo',
    method: 'get',
    params: query
  })
}
