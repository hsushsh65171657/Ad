from instagrapi import Client

username = "اسم_المستخدم"
password = "كلمة_المرور"

cl = Client()
cl.login(username, password)

followers = cl.user_followers(cl.user_id)
follower_ids = list(followers.keys())

medias = cl.user_medias(cl.user_id, 10)
active_users = set()
for media in medias:
    for liker in cl.media_likers(media.id):
        active_users.add(liker.pk)
    for comment in cl.media_comments(media.id):
        active_users.add(comment.user.pk)

inactive = [uid for uid in follower_ids if uid not in active_users]
print("عدد المتابعين غير المتفاعلين:", len(inactive))

for uid in inactive:
    user = cl.user_info(uid)
    print("حذف:", user.username)
    cl.user_remove_follower(uid)
