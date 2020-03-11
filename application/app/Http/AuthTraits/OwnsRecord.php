<?php 
namespace App\Http\AuthTraits;
use Illuminate\Support\Facades\Auth;
use App\Role;
trait OwnsRecord
{
	public function userNotOwnerOf($modelRecord)
	{
		return $modelRecord->user_id != Auth::id();
	}

	public function currentUserOwns($modelRecord)
	{
		return $modelRecord->user_id === Auth::id();
	}

	// public function adminOrCurrentUserOwns($modelRecord)
	// {
	// 	$roles = Auth::user()->roles()->first();
	// 	if($roles->name == 'administrator')
	// 	{
	// 		return true;
	// 	}

	// 	return $modelRecord->user_id === Auth::id();
	// }
}



 ?>