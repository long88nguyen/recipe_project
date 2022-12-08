//authentication
const LOGIN = '/api/login'

// category
const LIST_CATEGORY = '/api/category';
const CATEGORY_CREATE = '/api/category';
const CATEGORY_DETAIL = '/api/category';
const CATEGORY_UPDATE = '/api/category';
const CATEGORY_DELETE = '/api/category';

//post

const LIST_ALL_POST = '/api/post/get-list'
const SHOW_APPROVE ='/api/post/show-approval'
const APPROVE_POST ='/api/post/approve'

//common
const LIST_COMMON = '/api/common'; 
export default {
    //common
    LIST_COMMON,

    //category
    LIST_CATEGORY,
    CATEGORY_CREATE,
    CATEGORY_DETAIL,
    CATEGORY_UPDATE,
    CATEGORY_DELETE,

    //post
    LIST_ALL_POST,
    SHOW_APPROVE,
    APPROVE_POST,

    //authentication
    LOGIN

}