# Facebook API Request Proof of Concept

This is a very simple version for testing Facebook API requests.

## ⚙️ Preparations

### 👶 1. Create an app

1. Open [Facebook Developer Console](https://developers.facebook.com/?utm_source=chatgpt.com)
2. Go to "My Apps"
3. Create a new app 
   - Select Miscellaneous (or other) as __Usecase__ in step 2 
   - Select __Business__ as App Type

Now you have an __app ID__ and __app secret__.

### 🔐 2. Get an access token (Short lived)

1. Open [Graph API Console](https://developers.facebook.com/tools/explorer/?utm_source=chatgpt.com)
2. Select your __previously created app__ as  _Meta-App_
3. Select __User Access Token__ as _User or page_
5. Add the following permissions as _Authorisations_ (_Permissions_):
   - `pages_show_list`
   - `pages_read_engagement`
6. Click __Generate Access Token__

Now you have an short lived __access token__ for your app which you can use in the app.

## 🚀 Usage

1. Open `index.php`
2. Fill in the __app ID__, __app secret__, __short lived token__ and click __Submit__ in the first section.
3. In a new window it shows you then a list of all pages you have access to including __page_id__. Aswell as the __access token__ for each page.
4. Fill in the __ID__ (4), __Page Access Token (never-expire)__ (5) and click __Submit__ in the second section.
5. In a new window it shows you the __posts__ of the page.

> [!NOTE]
> The __access token__ for the page is __never-expire__ and you can use it for all requests.

> [!WARNING]
> This code was successfully tested with graph api version 19.0 & 23.0.
The code should not be adapted "as is" but rather as a starting point for your own implementation.
__It is not intended to be used in production__.

