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
const LIST_POST_APPROVED ='/api/post'
const CREATE_POST ='/api/post'
const SEARCH_POST_APPROVED ='/api/post/search-result'
const POST_DETAIL = '/api/post/detail'
const MY_POST = '/api/post/my-post'

//rate 

const POST_RATE_LIST = '/api/rate/list-rate'
const POST_RATE = '/api/rate'

//ingredient 



const LIST_ALL_INGREDIENT = '/api/ingredient'

// favourite 

const FAVOURITE_POST = '/api/favourite'
const DELETE_FAVORITE = '/api/favourite'


//direction 

const LIST_ALL_DIRECTION = '/api/direction'

// post-image

const LIST_ALL_POST_IMAGE = '/api/post-image'

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
    LIST_POST_APPROVED,
    SEARCH_POST_APPROVED,
    CREATE_POST,
    POST_DETAIL,
    MY_POST,

    //favourite

    FAVOURITE_POST,
    DELETE_FAVORITE,

    //rate
    POST_RATE_LIST,
    POST_RATE,

    //ingredient
    LIST_ALL_INGREDIENT,

    //direction
    LIST_ALL_DIRECTION,

    //post_image    
    LIST_ALL_POST_IMAGE,

    //authentication
    LOGIN

}