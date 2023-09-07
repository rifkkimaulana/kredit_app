<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class Google extends BaseController
{
    // Google API Login
    public function googleAuth()
    {
        if ($this->googleData) {
            $clientId = $this->googleData['client_id'];
            $clientSecret = $this->googleData['client_secret'];

            $authUrl = $this->createAuthUrl($clientId, $clientSecret);
            return redirect()->to($authUrl);
        } else {
            return redirect()->to(base_url('login'))->with('error', 'Kami tidak dapat memverifikasi anda silahkan hubungi developer aplikasi untuk mengatur api autentikasi.');
        }
    }

    private function createAuthUrl($clientId, $clientSecret)
    {
        $redirectUri = base_url('google/callback');
        $params = array(
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'online',
            'prompt' => 'select_account',
        );

        $url = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($params);
        return $url;
    }

    public function googleAuth_callback()
    {
        if ($this->googleData) {
            $client_id = $this->googleData['client_id'];
            $client_secret = $this->googleData['client_secret'];
            $redirect_uri = base_url('google/callback');

            if ($this->request->getGet('code')) {
                $code = $this->request->getGet('code');
                $access_token = $this->getAccessToken($code, $client_id, $client_secret, $redirect_uri);

                if ($access_token) {
                    $userInfo = $this->getUserInfo($access_token);

                    $user = $this->usersModel->where('email', $userInfo['email'])->first();

                    if ($user) {
                        session()->set('user_id', $user['user_id']);
                        session()->set('user_level', $user['user_level']);
                        session()->set('ApplicationId', $user['app_id']);
                    }

                    if (!$user) {
                        return redirect()->to(base_url('login'))->with('error', 'Email tidak terdaftar atau belum diverifikasi');
                    }

                    if (session('user_level') === 'administrator') {
                        return redirect()->to(base_url('meta/dashboard'));
                    } else {
                        if (!empty($this->aplikasi['slug'])) {
                            return redirect()->to(base_url($this->aplikasi['slug']));
                        }
                        return redirect()->to(base_url('login'));
                    }
                } else {
                    return redirect()->to(base_url('login'))->with('error', 'Gagal mendapatkan token akses dari Google.');
                }
            } else {
                return redirect()->to(base_url('login'))->with('error', 'Kode otorisasi tidak ditemukan.');
            }
        } else {
            return redirect()->to(base_url('login'))->with('error', 'Data Google API tidak ditemukan');
        }
    }

    private function getAccessToken($code, $client_id, $client_secret, $redirect_uri)
    {
        $params = array(
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code',
        );

        $url = 'https://oauth2.googleapis.com/token';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);

        if (isset($response['access_token'])) {
            return $response['access_token'];
        } else {
            return null;
        }
    }

    private function getUserInfo($access_token)
    {
        $url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;
        $result = file_get_contents($url);
        $response = json_decode($result, true);
        return $response;
    }
}
