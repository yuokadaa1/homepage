import urllib3
import json
import sys

http = urllib3.PoolManager()
KEY = 'AAAAAAAAAAAAAAAAAAAAACwgHwEAAAAAtDtHjGC9fhSdqbYdcPQIOTb%2Fd%2F0%3DgfB2IdydyYfyw9Ao1YXLZ440FWyS491QzYNc02zs5OyTeMwyjb'
args = sys.argv

def getTweetByText(http,key,searchFeild):

    url  = 'https://api.twitter.com/2/tweets/search/recent'
    req = http.request('GET',url,headers= {'Authorization': 'Bearer '+key},fields = searchFeild)

    result = json.loads(req.data)

    return result

#5.もっと詳細も調べてみよう
# 1319111286068633601
# 受け取った引数（id）で検索
params5 = {'query'        : 'conversation_id:' + args[1],
          'max_results'  : 10,
          'expansions'   : 'author_id,attachments.media_keys',
          'media.fields' : 'preview_image_url,type',
          'place.fields' : 'country,country_code',
          'tweet.fields' : 'created_at,lang,conversation_id',
          'user.fields'  : 'created_at,description,id,name,username',}

tweet_data = []
tweet_meta = []
getTweet = getTweetByText(http, KEY, params5)
# data は配列内に連想配列、metaは連想配列なのでdataは分解する
for value in getTweet['data']:
    tweet_data.append(value)
tweet_meta.append(getTweet['meta'])
while ('next_token' in getTweet['meta']):
    params5['next_token'] = getTweet['meta']['next_token']
    getTweet = getTweetByText(http, KEY, params5)
    for value in getTweet['data']:
        tweet_data.append(value)
    tweet_meta.append(getTweet['meta'])

returnData = {"statuses":tweet_data,"search_metadata":tweet_meta}
print(returnData)
