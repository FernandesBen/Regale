public class Hailstone {	
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		// reproduce secquence for 5
		int n=1;
		int rounds=1;
		int sequence = n;
		while(sequence!=1) {
				
			if(sequence%2==1) {
				sequence=sequence*3+1;
				System.out.println("yes");
			}
			else {
				sequence=sequence/2;
				System.out.println("stop");
			}
			rounds=rounds+1;
		}
		System.out.println(sequence + "this is round "+rounds);
	}

}
