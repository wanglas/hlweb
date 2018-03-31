<?php
namespace Admin\Controller;
use Admin\Controller;
/**
 * 后台权限管理
 */
class RuleController extends CommonAdminController{

//******************权限***********************
    /**
     * 权限列表
     */
    public function index(){
      $data=D('auth_rule')->getTreeData('tree','id','title');
      $assign=array(
          'data'=>$data
          );
      $this->assign($assign);
      $this->display();
    }

    /**
     * 添加权限
     */
    public function add(){
        $data=I('post.');
        unset($data['id']);
        $result=D('auth_rule')->addData($data);
        if ($result) {
            $this->success('添加成功',U('Admin/Rule/index'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 修改权限
     */
    public function edit(){
        $data=I('post.');
        $map=array(
            'id'=>$data['id']
            );
        $result=D('auth_rule')->editData($map,$data);
        if ($result) {
            $this->success('修改成功',U('Admin/Rule/index'));
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 删除权限
     */

    public function delete(){
        $id=I('get.id');
        $map=array(
            'id'=>$id
            );
        $result=D('auth_rule')->deleteData($map);
        if($result){
            $this->success('删除成功',U('Admin/Rule/index'));
        }else{
            $this->error('请先删除子权限');
        }

    }
//*******************用户组**********************
    /**
     * 用户组列表
     */
    public function group(){
        $data=D('auth_group')->select();
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加用户组
     */
    public function add_group(){
        $data=I('post.');
        unset($data['id']);
        $result=D('auth_group')->addData($data);
        if ($result) {
            $this->success('添加成功',U('Admin/Rule/group'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 修改用户组
     */
    public function edit_group(){
        $data=I('post.');
        $map=array(
            'id'=>$data['id']
            );
        $result=D('auth_group')->editData($map,$data);
        if ($result) {
            $this->success('修改成功',U('Admin/Rule/group'));
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 删除用户组
     */
    public function delete_group(){
        $id=I('get.id',0,'intval');
        $map=array(
            'id'=>$id
            );
        $result=D('auth_group')->deleteData($map);
        if ($result) {
            $this->success('删除成功',U('Admin/Rule/group'));
        }else{
            $this->error('删除失败');
        }
    }

//*****************权限-用户组*****************
    /**
     * 分配权限
     */
    public function rule_group(){
        if(IS_POST){
            $data=I('post.');
            $map=array(
                'id'=>$data['id']
                );
            $data['rules']=implode(',', $data['rule_ids']);
            $result=D('auth_group')->editData($map,$data);
            if ($result) {
                $this->success('操作成功',U('Admin/Rule/group'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $id=I('get.id');
            // 获取用户组数据
            $group_data=M('auth_group')->where(array('id'=>$id))->find();
            $group_data['rules']=explode(',', $group_data['rules']);
            // 获取规则数据
            $rule_data=D('auth_rule')->getTreeData('level','id','title');
            $assign=array(
                'group_data'=>$group_data,
                'rule_data'=>$rule_data
                );
            $this->assign($assign);
            $this->display();
        }

    }
//******************用户-用户组*******************
    /**
     * 添加成员
     */
    public function check_user(){
        $username=I('get.username','');
        $group_id=I('get.group_id');
        $group_name=M('auth_group')->getFieldById($group_id,'title');
        $uids=D('auth_group_access')->getUidsByGroupId($group_id);
        // 判断用户名是否为空
        if(empty($username)){
            $user_data='';
        }else{
            $user_data=M('users')->where(array('username'=>$username))->select();
        }
        $assign=array(
            'group_name'=>$group_name,
            'uids'=>$uids,
            'user_data'=>$user_data,
            );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加用户到用户组
     */
    public function add_user_to_group(){
        $data=I('get.');
        $map=array(
            'uid'=>$data['uid'],
            'group_id'=>$data['group_id']
            );
        $count=M('auth_group_access')->where($map)->count();
        if($count==0){
            D('auth_group_access')->addData($data);
        }
        $this->success('操作成功',U('Admin/Rule/check_user',array('group_id'=>$data['group_id'],'username'=>$data['username'])));
    }

    /**
     * 将用户移除用户组
     */
    public function delete_user_from_group(){
        $map=I('get.');
        $result=D('auth_group_access')->deleteData($map);
        if ($result) {
            $this->success('操作成功',U('Admin/Rule/admin_user_list'));
        }else{
            $this->error('操作失败');
        }
    }

    /**
     * 管理员列表
     */
    public function admin_user_list(){
        $data=D('auth_group_access')->getAllData();
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加管理员
     */
    public function add_admin(){
        if(IS_POST){
            $data=I('post.');
            $result=D('users')->addData($data);
            if($result){
                if (!empty($data['group_ids'])) {
                    foreach ($data['group_ids'] as $k => $v) {
                        $group=array(
                            'uid'=>$result,
                            'group_id'=>$v
                            );
                        D('auth_group_access')->addData($group);
                    }
                }
                // 操作成功
                $this->success('添加成功',U('Admin/Rule/admin_user_list'));
            }else{
                $error_word=D('users')->getError();
                // 操作失败
                $this->error($error_word);
            }
        }else{
            $data=D('auth_group')->select();
            $assign=array(
                'data'=>$data
                );
            $this->assign($assign);
            $this->display();
        }
    }

    /**
     * 修改管理员
     */
    public function edit_admin(){
        if(IS_POST){
            $data=I('post.');
            // 组合where数组条件
            $uid=$data['id'];
            $map=array(
                'id'=>$uid
                );
            // 修改权限
            D('auth_group_access')->deleteData(array('uid'=>$uid));
            foreach ($data['group_ids'] as $k => $v) {
                $group=array(
                    'uid'=>$uid,
                    'group_id'=>$v
                    );
                D('auth_group_access')->addData($group);
            }
            $data=array_filter($data);
            // 如果修改密码则md5
            if (!empty($data['password'])) {
                $data['password']=md5($data['password']);
            }
            // p($data);die;
            $result=D('users')->editData($map,$data);
            if($result){
                // 操作成功
                $this->success('编辑成功',U('Admin/Rule/edit_admin',array('id'=>$uid)));
            }else{
                $error_word=D('users')->getError();
                if (empty($error_word)) {
                    $this->success('编辑成功',U('Admin/Rule/edit_admin',array('id'=>$uid)));
                }else{
                    // 操作失败
                    $this->error($error_word);
                }

            }
        }else{
            $id=I('get.id',0,'intval');
            // 获取用户数据
            $user_data=M('users')->find($id);
            // 获取已加入用户组
            $group_data=M('auth_group_access')
                ->where(array('uid'=>$id))
                ->getField('group_id',true);
            // 全部用户组
            $data=D('auth_group')->select();
            $assign=array(
                'data'=>$data,
                'user_data'=>$user_data,
                'group_data'=>$group_data
                );
            $this->assign($assign);
            $this->display();
        }
    }
}
