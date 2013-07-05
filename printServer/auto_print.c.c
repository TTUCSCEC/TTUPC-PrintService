#include<stdio.h>
#include<string.h>
#include<windows.h>

int main(){
	
	FILE *in;
	int sec = 10;
	char filename[50];
	char batPath[100];
	char postUrl[100];
	char rsync[100] = "rsync -av --delete -e 'ssh -p 22' user@127.0.0.1:/upload /";


	for( ; ;){
		filename[0] = '\0';
		strcpy(batPath, "C:\\print.bat C:\\Cygwin\\upload\\");
		strcpy(postUrl, "ab http://127.0.0.1/printadmin/setPrinted.php?realname=");
		printf("%s\n", batPath);

		//get need print file
		system("ls C:\\Cygwin\\upload > tmp");
		Sleep(500);

		in = fopen("tmp", "r");
		fscanf(in, " %s", filename);
		printf("%s", filename);

		//someone file need to print
		if(filename[0] != '\0'){
			strcat(batPath, filename);
			printf("%s\n\n", batPath);
			system(batPath);

			strcat(postUrl, filename);
			printf("%s\n\n", postUrl);
			system(postUrl);
		}
		
		Sleep(sec * 1000);
		system(rsync);
	}
}
