<?php

namespace App\Repositories\Post;

use App\Enums\Constant;
use FormatHelper;
use App\Enums\ErrorType;
use App\Models\Direction;
use App\Models\Favourite;
use App\Models\Ingredient;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Rate;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Post\PostRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Exception;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ImageHelper;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Post;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll($request){
        $perPage = $request->input('per_page', 5);
        $sortColumn = $request->input('sort_column', Constant::DEFAULT_SORT_COLUMN_RESPONSE);
        $sortBy = $request->input('sort_by', Constant::DEFAULT_SORT_BY_RESPONSE);
        $postList = $this->model->with("member:id,name","category:id,name");
        $postList = $postList->orderBy( $sortColumn,$sortBy);

        if ($request->has('status') && $request->status) {
            $postList->where('posts.status', $request->status);
        }

        if ($request->has('category_name') && $request->category_name)
        {
            $postList->whereHas("category",function($query) use($request){
                $query->where('categories.name', 'LIKE', '%' . FormatHelper::escape_like($request->category_name) . '%');
            });
        }

        if ($request->has('member_name') && $request->member_name)
        {
            $postList->whereHas("member",function($query) use($request){
                $query->where('members.name', 'LIKE', '%' . FormatHelper::escape_like($request->member_name) . '%');
            });
        }
        $postList =  $postList->paginate($perPage);
        return [
            'postList' =>$postList,
        ];
    }
    
    public function getListApproved($request)
    {
        $memberId = Auth::user()->member->id;
        $dataPost = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->with("PostImage:id,post_id,image","member:id,name,avatar")
        ->where('posts.status',2)
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at");

        if ($request->has('category_id') && $request->category_id) {
            $dataPost->where('posts.category_id', $request->category_id);
        }

        if ($request->has('title') && $request->title)
        {
            $dataPost->where('posts.title', 'LIKE', '%' . FormatHelper::escape_like($request->title) . '%');
        }
        $getList = $dataPost->paginate(8);
        $getList->map(function($value) use($memberId){
            $checkFavourite = Favourite::where('member_id',$memberId)->where('post_id',$value->id)->first();
            if($checkFavourite)
            {
                $value->favouriteable = false;
            }
            else
            {
                $value->favouriteable = true;
            }
            
            // foreach($value['PostImage'] as $item){
            //     $item->image = ImageHelper::getS3FileUrl($item->image);
            // }
        });

        // foreach($getList as $item)
        // {
        //     $item->member->avatar = ImageHelper::getS3FileUrl($item->member->avatar);
        // }
       
        $postOrder = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->with("PostImage:id,post_id,image")
        ->where('posts.status',2)
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at");
        $getOrder = $postOrder->orderBy("id","DESC")->limit(6)->get();
        $getOrder->map(function($value) use($memberId){
            $checkFavourite = Favourite::where('member_id',$memberId)->where('post_id',$value->id)->first();
            if($checkFavourite)
            {
                $value->favouriteable = false;
            }
            else
            {
                $value->favouriteable = true;
            }
            // foreach($value['PostImage'] as $item){
            //     $item->image = ImageHelper::getS3FileUrl($item->image);
            // }
        });
       
        return [
          "dataPost" => $getList,
          
          "getOrder" => $getOrder,
        ];
    }

    public function SearchPost($request)
    {
        $memberId = Auth::user()->member->id;
        $searchPost = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->with("PostImage:id,post_id,image","Ingredients:id,name,post_id","member:id,name,avatar")
        ->where('posts.status',2)
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at");
        // dd($request->all());
        if ($request->has('title') && $request->title)
        {

            $searchPost->where('posts.title', 'LIKE', '%' . FormatHelper::escape_like($request->title) . '%');
        }


        if ($request->has('category_name') && $request->category_name)
        {
            $searchPost->whereHas("category",function($query) use($request){
                $query->where('categories.name', 'LIKE', '%' . FormatHelper::escape_like($request->category_name) . '%');
            });
        }

        if ($request->has('ingredient_name') && $request->ingredient_name)
        {
            $searchPost->whereHas("Ingredients",function($query) use($request){
                $query->where('ingredients.name', 'LIKE', '%' . FormatHelper::escape_like($request->ingredient_name) . '%');
            });
        }

        if ($request->has('member_name') && $request->member_name)
        {
            $searchPost->whereHas("member",function($query) use($request){
                $query->where('members.name', 'LIKE', '%' . FormatHelper::escape_like($request->member_name) . '%');
            });
        }

        $listAll = $searchPost->get();

        $listAll->map(function($value) use($memberId){
            $checkFavourite = Favourite::where('member_id',$memberId)->where('post_id',$value->id)->first();
            if($checkFavourite)
            {
                $value->favouriteable = false;
            }
            else
            {
                $value->favouriteable = true;
            }

            // $value->member->avatar = ImageHelper::getS3FileUrl($value->member->avatar);
            
            // foreach($value['PostImage'] as $item){
            //     $item->image = ImageHelper::getS3FileUrl($item->image);
            // }
        });

        $getFavourite = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->with("PostImage:id,post_id,image")
        ->where('posts.status',2)
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at");
        $listMostFavourite = $getFavourite->orderBy("count_favourite","DESC")->limit(3)->get();
        $listMostFavourite->map(function($value) use($memberId){
            $value->duration = strtotime(Carbon::now()->format("Y-m-d H:i:s")) - strtotime(Carbon::parse($value->created_at)->format("Y-m-d H:i:s")); 
            $checkFavourite = Favourite::where('member_id',$memberId)->where('post_id',$value->id)->first();
            if($checkFavourite)
            {
                $value->favouriteable = false;
            }
            else
            {
                $value->favouriteable = true;
            }
            // foreach($value['PostImage'] as $item){
            //     $item->image = ImageHelper::getS3FileUrl($item->image);
            // }
        });
         
        return [
        "searchPost" => $listAll,
        "listMostFavourite" => $listMostFavourite,
        ];
    }

    public function store($request)
    {
        try{
            DB::beginTransaction();
            $data = $request->all();
            $memberId = Auth::user()->member->id;
            $timeNow = Carbon::now();
            $dataPost = [
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => 1,
                'category_id' => $data['category_id'],
                'member_id' => $memberId,
                'nutrition_facts' => $data['nutrition_facts'] != null ? $data['nutrition_facts'] : $data['nutrition_facts'] = null,
                'note' => $data['note']!= null ? $data['note']  : $data['note'] = null,
                'time' => $data['time'],
                'created_at' => $timeNow,
                'updated_at' => $timeNow,
            ];
            $postSave = $this->model->create($dataPost);
            $arrIngredient = $data['ingredients'];
            foreach ($arrIngredient as $key => $item)
            {
                    $dataIngredient  = [
                        'post_id' => $postSave->id,
                        'name' => $item,
                        'created_at' => $timeNow,
                        'updated_at'=> $timeNow,
                    ];
                    Ingredient::insert($dataIngredient);
            }
    
           $arrDirection = $data['directions'];
           foreach ($arrDirection as $key => $item)
            {
                    $dataDirection  = [
                        'post_id' => $postSave->id,
                        "step" => $key,
                        'description' => $item,
                        'created_at' => $timeNow,
                        'updated_at'=> $timeNow,
                    ];
                    Direction::insert($dataDirection);
            }
    
            if($request->file('img_evidence'))
            {
                $arrImage = $request->file('img_evidence');
                foreach ($arrImage as $key => $item)
                {
                    // $image = $item;
                    $destinationPath = public_path('uploads/posts');
                    $profileImage = '/uploads/posts/' . random_int(100000,999999) . "." . $item->getClientOriginalExtension();
                    $item->move($destinationPath, $profileImage);
                    $data['image'] = $profileImage;

                        // $extension = $item->getClientOriginalName();
                        // $fileName = time().'-' .$request->name.'.'.$extension;
                        // $destinationPath = public_path('uploads/posts');
                        // $profileImage = random_int(100000000,99999999999) . "." . $item->getClientOriginalExtension();
                        // $item->move($destinationPath, $profileImage);
                        // $data['image'] = ImageHelper::uploadFileToS3($item,'images/posts');
                        $dataImage  = [
                            'post_id' => $postSave->id,
                            'image' =>  $data['image'] ,
                            'created_at' => $timeNow,
                            'updated_at'=> $timeNow,
                        ];
                        PostImage::insert($dataImage);
                }
            }

            DB::commit();

            return ['success' => true];
        }
        catch(Exception $e)
        {
            DB::rollBack();

            return [
                'success' => false,
                'code' => ErrorType::CODE_5000,
                'status_code' => ErrorType::STATUS_500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function showCreate()
    {
        return Category::all();
    }

    public function showApproval($id)
    {
        $dataApprove = $this->model       
        ->leftJoin('ingredients','posts.id','=','ingredients.post_id')
        ->leftJoin('directions','posts.id','=','directions.post_id')
        ->leftJoin('favourites','posts.id','=','favourites.post_id')
        ->leftJoin('post_images','posts.id','=','post_images.post_id')
        ->leftJoin('rates','posts.id','=','rates.post_id')
        ->leftJoin('favourites as f','posts.id','=','favourites.post_id')
        ->with('Ingredients','Directions','PostImage',"member:id,name")
        ->select('posts.*',DB::raw('count(f.id) as number_favourite,
        round(avg(rates.number_rating),1) as number_rating'))
        ->groupBy('id','title','content',
        'category_id','note','nutrition_facts',
        'time','member_id','status','created_at',
        'updated_at','deleted_at')
        ->where('posts.id',$id)
        ->first();

        // foreach($dataApprove['PostImage'] as $image)
        // {
        //     $image->image = ImageHelper::getS3FileUrl($image->image);
        // }
        return $dataApprove;
    }

    public function detail($id)
    {

        $memberId = Auth::user()->member->id;
        $postDetail = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->with("PostImage:id,post_id,image","Ingredients","Directions","member")
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at")
        ->where('posts.id',$id)
        ->first();
     
        $checkFavourite = Favourite::where('member_id',$memberId)->where('post_id',$postDetail->id)->first();
        if($checkFavourite)
        {
            $postDetail->favouriteable = false;
        }
        else
        {
            $postDetail->favouriteable = true;
        }
        // foreach( $postDetail['PostImage'] as $value)
        // {
        //     $value->image = ImageHelper::getS3FileUrl($value->image);
        // }
        // $postDetail['member']['avatar'] = ImageHelper::getS3FileUrl($postDetail['member']['avatar']);
        $postDetail->rateable = Rate::where("member_id",$memberId)->where("post_id",$id)->first() ? true : false;
        return [
            "postDetail" => $postDetail
            ];
    }

    public function update($id,$request)
    {
        try{
            DB::beginTransaction();
            $data = $request;

            $memberId = Auth::user()->member->id;
            

            $timeNow = Carbon::now();

            $dataPostById = $this->model->findOrFail($id);

            Ingredient::where('post_id',$dataPostById->id)->delete();
           
            Direction::where('post_id',$dataPostById->id)->delete();

            $dataPost = [
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => 1,
                'category_id' => $data['category_id'],
                'member_id' => $memberId,
                'nutrition_facts' => $data['nutrition_facts'] ? $data['nutrition_facts'] != null : $data['nutrition_facts'] = null,
                'note' => $data['note'] ? $data['note'] != null : $data['note'] = null,
                'time' => $data['time'],
                'updated_at' => $timeNow,
            ];

            $dataPostById->update($dataPost);

            $arrIngredient = $data['ingredients'];
            foreach ($arrIngredient as $key => $item)
            {
                    $dataIngredient  = [
                        'post_id' => $dataPostById->id,
                        'name' => $item,
                        'created_at' => $timeNow,
                        'updated_at'=> $timeNow,
                    ];
                    Ingredient::insert($dataIngredient);
            }
    
           $arrDirection = $data['directions'];
           foreach ($arrDirection as $key => $item)
            {
                    $dataDirection  = [
                        'post_id' => $dataPostById->id,
                        "step" => $key,
                        'description' => $item,                      
                        'created_at' => $timeNow,
                        'updated_at'=> $timeNow,
                    ];
                    Direction::insert($dataDirection);
            }
            if($request->file('img_evidence'))
            {
                PostImage::where('post_id',$dataPostById->id)->delete();
                $arrImage = $request->file('img_evidence');
                foreach ($arrImage as $key => $item);
                {
                        $destinationPath = public_path('uploads/posts');
                        $profileImage = random_int(100000000,99999999999) . "." . $item->getClientOriginalExtension();
                        $item->move($destinationPath, $profileImage);
                        $data['image'] = "$profileImage";
                        $dataImage  = [
                            'post_id' => $dataPostById->id,
                            'image' =>  "/uploads/posts/".$data['image'],
                            'created_at' => $timeNow,
                            'updated_at'=> $timeNow,
                        ];
                        PostImage::insert($dataImage);
                }

            }
                
            DB::commit();

            return ['success' => true];
        }
        catch(Exception $e)
        {
            DB::rollBack();

            return [
                'success' => false,
                'code' => ErrorType::CODE_5000,
                'status_code' => ErrorType::STATUS_500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->model->destroy($id);
             Ingredient::where('post_id',$id)->delete();
             $listPost = PostImage::where('post_id',$id)->get();
            foreach($listPost as $item)
            {
                if(File::exists(mb_substr($item->image,strpos($item->image, "_") + 1)))
                {
                    File::delete((mb_substr($item->image,strpos($item->image, "_") + 1)));
                }
            }
            PostImage::where('post_id',$id)->delete();
            
            Direction::where('post_id',$id)->delete();

            Rate::where('post_id',$id)->delete();

            Favourite::where('post_id',$id)->delete();

            DB::commit();
            return [
                'success' => true
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'code' => ErrorType::CODE_5000,
                'status_code' => ErrorType::STATUS_500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function approve($request,$id)
    {
        try{
            DB::beginTransaction();
            // $data = $request->all();

            $memberId = Auth::user()->member->id;
        
            $timeNow = Carbon::now();

            $dataPostById = $this->model->findOrFail($id);

            $dataPost = [    
                'reason' => $request->reason,  
                'status' => $request->status,
                
                'updated_at' => $timeNow
            ];
            $dataPostById->update($dataPost);  

            DB::commit();

            return ['success' => true];
        }
        catch(Exception $e)
        {
            DB::rollBack();

            return [
                'success' => false,
                'code' => ErrorType::CODE_5000,
                'status_code' => ErrorType::STATUS_500,
                'message' => $e->getMessage()
            ];
        }
    }

    public function GetListFavourite()
    {
        $memberId = Auth::user()->member->id;
        $favouritePost = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->with("PostImage")
        ->where('posts.status',2)
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at",'favourites.member_id')
        ->where("favourites.member_id",$memberId)->get();
        foreach($favouritePost as $value)
        {
            $checkFavourite = Favourite::where('member_id',$memberId)->where('post_id',$value->id)->first();
            if($checkFavourite)
            {
                $value->favouriteable = false;
            }
            else
            {
                $value->favouriteable = true;
            }
            // foreach($value['PostImage'] as $item){
            //     $item->image = ImageHelper::getS3FileUrl($item->image);
            // }
        }
       
        return [
            'listMyFavourites' => $favouritePost
        ]; 
    }

    public function MyPost()
    {
        $memberId = Auth::user()->member->id;
        $myPost = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->with("PostImage")
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at")
        ->where("posts.member_id",$memberId)->get();
        // foreach($myPost as $value)
        // {
        //     foreach($value['PostImage'] as $item){
        //         $item->image = ImageHelper::getS3FileUrl($item->image);
        //     }
        // }
        return [
            'listMyPost' => $myPost
        ]; 
    }

    public function YourPost($id)
    {
        $YourPost = $this->model->leftjoin("favourites","favourites.post_id","posts.id")
        ->select([
            "posts.*",
            DB::raw('(select count(*) from favourites where favourites.post_id = posts.id) as count_favourite' ),
            DB::raw('(select round(avg(number_rating),1) from rates where rates.post_id = posts.id) as number_rating' )
        ])
        ->with("PostImage")
        ->where('posts.status',2)
        ->groupBy("id","title","content",
        "category_id","member_id",
        "time","status","created_at",
        "updated_at","nutrition_facts",
        "note","deleted_at")
        ->where("posts.member_id",$id)->limit(5)->get();
        // foreach($YourPost as $value)
        // {
        //     foreach($value['PostImage'] as $item){
        //         $item->image = ImageHelper::getS3FileUrl($item->image);
        //     }
        // }
        
        return [
            'listYourPost' => $YourPost
        ];
    }


}


