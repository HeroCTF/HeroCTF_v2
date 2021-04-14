#include <stdio.h>
#include <string.h>
#define INPUT_SIZE 19

void nasaRestrictedContent(){
        char* keykey = "S3cr3tK3yS3cr3tK3y";
        int pass[] = {0x1b, 0x56, 0x11, 0x1d, 0x70, 0x20, 0x0d, 0x48, 0x38, 0x01, 0x7e, 0x10, 0x06, 0x41, 0x1b, 0x25, 0x54, 0x04, 0x00};
        char pass_input[INPUT_SIZE];
        int superbool = 1;

        printf("\nDesactivez-moi cette alarme : ");
        fgets(pass_input, INPUT_SIZE, stdin);

        for(int i=0; i<INPUT_SIZE; i++)
                if((pass_input[i]^keykey[i]) != pass[i])
                        superbool = 0;

        if (superbool == 1)
                printf("Bravo, vous venez de sauver le lancement d\'Arianne 42 :)\n");
        else
                printf("ECHEC !\n");
}

int main(){
        nasaRestrictedContent();
        return 0;
}
