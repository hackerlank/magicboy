package my
{
	public class VideoItemParameter
	{
		//private static const FMS_HOST: String = "localhost";
		//private static const FMS_HOST: String = "192.168.0.151";
		//private static const FMS_HOST: String = "118.192.41.231";

		public var sip: String = 'localhost';
		public var sid: String;
		public var rid: int = 1;
		public var vid: int = 0;
		public var uid: String = '';
		public var nick: String = '';
		public var role: int = 0;
		public var logo: String = '';
		public var score: int = 888;
		public var area: String = '';
		public var level: String = '';
		public var sex: String = '';
		public var occupation: String = '';
		public var appname: String = '';
		
		public var mic_rate: int = 16; // 5 8(def) 11 16 22 44
		[Bindable]
		public var mic_gain: Number = 50.0; // 1-100  50(def)
		[Bindable]
		public var wav_gain: Number = 1.0; // 1-100  50(def)

		public var cam_width: int = 267;
		public var cam_height: int = 200;
		public var cam_fps: int = 20;
		public var cam_bd: int = 0;
		public var cam_quality: int = 90; // 1-100
		public var cam_keyFrame: int = 10; // 1-48
		
		public function VideoItemParameter()
		{
		}
		
		public function getProtocol(): String {
			return vid == 1 ? "rtmp" : "rtmp";
		}
		
		public function getAppURL(): String {
			return getProtocol() + "://" + sip + "/" + appname;
		}
		
		/*
		private function getAppName(): String{
			var ret: String = "room_" + rid;
			if(vid == 2){
				ret += "v";
			}
			else if(vid == 3){
				ret += "w";
			}
			
			if(vid == 3){
				ret = 'room_1v';
			}
			
			return ret;
		}
		*/
		
		public function getStreamName(): String{
			return 'chat';
			//return getRoomName() + "_v" + vid;
		}

		private function getRoomName(): String{
			return "room_" + rid;
		}		
	}
}