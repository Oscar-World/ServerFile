import java.io.IOException;
import java.io.BufferedReader;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;
import java.util.HashMap;
import java.io.InputStreamReader;


public class SocketServer {
	
    private ServerSocket s_socket = null;
    private Socket c_socket = null;

    ArrayList<SocketThread> list = new ArrayList<SocketThread>();
    HashMap<String, SocketThread> map = new HashMap<String, SocketThread>();
    

    public void serverStart() {

        try {

            s_socket = new ServerSocket(8888);
            System.out.println("== 소켓 통신 시작 ==");

            while(true) {

                c_socket = s_socket.accept();
                SocketThread thread = new SocketThread();
                list.add(thread);
                System.out.println(list.size());
                for (int i = 0; i<list.size(); i++) {
                    System.out.println(list.get(i));
                }
                thread.start();

            }

        } catch(Exception e) {
            System.out.println("serverStart() Exception : " + e);
            e.printStackTrace();
        }

    } // serverStart()
    
    
    public static void main(String[] args){
    	
    	SocketServer server = new SocketServer();
    	server.serverStart();
    	
    } // main()
    
    
    public void chat(SocketThread user1, SocketThread user2, String msg) {

        if (user1 != null & user2 != null) {

            user1.printWriter.println(msg);
            user1.printWriter.flush();
            user2.printWriter.println(msg);
            user2.printWriter.flush();

        } else {
            if (user1 == null) {
                user2.printWriter.println(msg);
                user2.printWriter.flush();
            } else {
                user1.printWriter.println(msg);
                user1.printWriter.flush();
            }
        }
    	

    	
    } // chat()


    class SocketThread extends Thread{

        String msg;
        String[] msgArray;
        String[] user;
        String hashKey;
        
        private BufferedReader bufferedReader = null;
        private PrintWriter printWriter = null;
    
        @Override
        public void run(){
            super.run();
            
            boolean status = true;
            
            try{
            	
            	bufferedReader = new BufferedReader(new InputStreamReader(c_socket.getInputStream()));
            	printWriter = new PrintWriter(c_socket.getOutputStream());
    
                while(status){
                	
                    msg = bufferedReader.readLine();
                    msgArray = msg.split("↖");
                    user = msgArray[0].split("↘");

                    if (user.length == 1) {
                        hashKey = msgArray[0];
                    } else {
                        hashKey = msgArray[0] + msgArray[1];
                    }

                    if (msgArray[1].equals("ⓐloginRoomⓐ")) {
                        System.out.println(msgArray[0] + "님이 채팅방 목록에 입장");
                        map.put(hashKey, this);
                        System.out.println("소켓 서버 접속 인원 : " + map.size());

                    } else if (msgArray[1].equals("ⓐlogoutRoomⓐ")) {
                        System.out.println(msgArray[0] + "님이 채팅방 목록에서 퇴장");
                        
                        map.remove(hashKey);
                        list.remove(this);
                        status = false;
                        System.out.println("소켓 서버 접속 인원 : " + map.size());

                    } else if (msgArray[4].equals("ⓐloginⓐ")) {

                        System.out.println("로그인 후 받은 메세지 : " + msg);
                    	
                    	map.put(hashKey, this);
                        System.out.println(msgArray[1] + "님이 " + msgArray[0] + " 방에 접속");
                        System.out.println("소켓 서버 접속 인원 : " + map.size());

                        SocketThread user1 = map.get(msgArray[0] + msgArray[1]);
                        SocketThread user2 = map.get(msgArray[0] + msgArray[2]);

                        if (user1 != null & user2 != null) {
                            chat(user1, user2, msg + "↖true");
                        } else if (user1 != null | user2 != null) {
                            System.out.println(msgArray[0] + "님은 로그인 했지만 상대는 접속 안함");
                            chat(user1, user2, msg + "↖false");
                        }

                    } else if (msgArray[4].equals("ⓐlogoutⓐ")){
                    	
                        System.out.println(msgArray[1] + "님이 나감");
                    	map.remove(hashKey);
                    	list.remove(this);
                        System.out.println("소켓 서버 접속 인원 : " + map.size());
                    	status = false;
                    	
                    } else if (map.containsKey(hashKey)){
                    	
                        System.out.println(msgArray[1] + " 님이 채팅 시도 : " + msgArray[4]);

                    	SocketThread user1 = map.get(msgArray[0] + msgArray[1]);
                        SocketThread user2 = map.get(msgArray[0] + msgArray[2]);

                        if (user1 != null & user2 != null) {
                            chat(user1, user2, msg + "↖true");
                        } else if (user1 != null | user2 != null) {
                            System.out.println(msgArray[1] + "님이 채팅을 시도했지만 받을 상대는 접속 안함");
                            SocketThread user3 = map.get(msgArray[2]);
                            if (user3 != null) {
                                chat(user1, user3, msg + "↖false");
                            } else {
                                chat(user1, user2, msg + "↖false");
                            }
                            
                        }

                    }
                } // while(status)
                
                this.interrupt();
                
            }catch(IOException e){
                System.out.println("SocketThread Exception : " + e);
                e.printStackTrace();
            }
            
        } // run()

    } // SocketThread
    

} // SocketServer
