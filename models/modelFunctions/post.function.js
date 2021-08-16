const db = require("../../dbHelper/connection");
module.exports.addNewPost = async (postData) => {
  try {
    var user = await db.post.create(postData);
  } catch (err) {
    console.log(err);
  }
  return user;
};
module.exports.deletePost = async (postId) => {
  try {
    var delUser = await db.post.destroy({
      where: {
        id: postId,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return delUser;
};
module.exports.findAllPost = async () => {
  try {
    var allPost = await db.post.findAll();
  } catch (err) {
    console.log(err);
  }
  return allPost;
};
module.exports.updatePost = async (postInfo, id) => {
  try {
    var updatedPost = await db.post.update(postInfo, {
      where: {
        id: id,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return updatedPost;
};

module.exports.findSinglePost = async (id) => {
  try {
    var singlePost = await db.post.findOne({
      where: {
        id: id,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return singlePost;
};
