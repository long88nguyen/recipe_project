//authentication
const LOGIN = '/api/login'
const REGISTER = '/api/register'

// category
const LIST_CATEGORY = '/api/category';
const CATEGORY_CREATE = '/api/category';
const CATEGORY_DETAIL = '/api/category/detail';
const CATEGORY_UPDATE = '/api/category';
const CATEGORY_DELETE = '/api/category';
const CATEGORY_POST = '/api/category/post-by-category';

//post

const LIST_ALL_POST = '/api/post/get-list'
const SHOW_APPROVE ='/api/post/show-approval'
const APPROVE_POST ='/api/post/approve'
const LIST_POST_APPROVED ='/api/post'
const CREATE_POST ='/api/post'
const SEARCH_POST_APPROVED ='/api/post/search-result'
const POST_DETAIL = '/api/post/detail'
const MY_POST = '/api/post/my-post'
const LIST_FAVOURITE_POST = '/api/post/list-favourite'
const YOUR_POST = '/api/post/your-post'
const UPDATE_POST = '/api/post/update'
const DELETE_POST = '/api/post'

//rate 

const POST_RATE_LIST = '/api/rate/list-rate'
const POST_RATE = '/api/rate'
const RATE_DETAIL = '/api/rate/rate-detail'
const UPDATE_RATE = '/api/rate/update-rate'
const DELETE_RATE = '/api/rate/delete'
const GET_ALL_RATE = '/api/rate'
const GET_STAT_RATE = '/api/rate/stat-rate'

//member 

const MEMBER_LIST = '/api/member'
const MEMBER_DETAIL = '/api/member'
const UPDATE_MEMBER = '/api/member'

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
    CATEGORY_POST,

    //post
    LIST_ALL_POST,
    SHOW_APPROVE,
    APPROVE_POST,
    LIST_POST_APPROVED,
    SEARCH_POST_APPROVED,
    CREATE_POST,
    POST_DETAIL,
    MY_POST,
    YOUR_POST,
    LIST_FAVOURITE_POST,
    UPDATE_POST,
    DELETE_POST,

    //favourite

    FAVOURITE_POST,
    DELETE_FAVORITE,

    //rate
    POST_RATE_LIST,
    POST_RATE,
    RATE_DETAIL,
    UPDATE_RATE,
    DELETE_RATE,
    GET_ALL_RATE,
    GET_STAT_RATE,

    //member
    MEMBER_LIST,
    MEMBER_DETAIL,
    UPDATE_MEMBER,

    //ingredient
    LIST_ALL_INGREDIENT,

    //direction
    LIST_ALL_DIRECTION,

    //post_image    
    LIST_ALL_POST_IMAGE,

    //authentication
    LOGIN,
    REGISTER

}