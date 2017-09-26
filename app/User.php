<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'status', 'password', 'token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Proverava da li neki korisnik ima odgovarajuci pristup
     *
     * @var array
     */
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }

    /**
     * Proverava da li neki korisnik ima odgovarajuce uloge
     *
     * @var array
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Proverava da li neki korisnik ima odgovarajucu ulogu
     *
     * @var string
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
        return true;
    }
      return false;
    }


    /**
     * Get user metas
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas() {
        return $this->hasMany(UserMeta::class);
    }

    /**
     * Get post meta value by key
     * @param $key
     * @return mixed
     */
    public function meta($key) {
        $meta_data = $this->hasMany(UserMeta::class)->where('meta_key', $key)->first();
        return $meta_data ? $meta_data->meta_value : false;
    }

    /**
     * Set user meta
     * @param $key
     * @param $value
     */
    public function setMeta($key, $value) {
        $new_meta = new UserMeta(['meta_key' => $key, 'meta_value' => $value]);
        return $this->metas()->save($new_meta);

    }


}
