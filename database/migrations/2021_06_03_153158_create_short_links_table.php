<?php  
    
use Illuminate\Support\Facades\Schema;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Database\Migrations\Migration;  
     
class CreateShortLinksTable extends Migration  
{  
    /**  
     * It is used to run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('short_links', function (Blueprint $table) {  
            $table->bigIncrements('id');  
            $table->string('code');  
            $table->string('link');  
            $table->timestamps();  
        });  
    }  
     
    /**  
     * It is used to reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('short_links');  
    }  
}  