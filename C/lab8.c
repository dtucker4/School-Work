#include <stdio.h>
#include <stdlib.h>
#define Mul 5
typedef struct {
	int data;
	struct node* rightPtr;

}ENTRY;

typedef struct node
{
	struct node* firstPtr;
	int numEntries;
	ENTRY entries[Mul];
}NODE;

typedef struct {
	int count;
	NODE* root;
}MTREE;

int main(void) {

	MTREE tree;
	
	 
}